<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\Vehicle;
use App\Driver;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use DB;

class ScheduleController extends Controller
{
    /**
     * Create a new controller innstance
     */
    public function __construct(){

        $this->middleware('auth:api');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(\Gate::allows('isAdminOrAccounts')){

            $sch = DB::table('schedules as sc')
                    ->join('trips as tr', 'sc.schedule_id', '=', 'tr.schedule_id')
                    ->join('drivers as dr', 'tr.driver_id', '=', 'dr.user_id')
                    ->select('sc.schedule_id', 'sc.sch_status', 'sc.opened', 'sc.sc_closed', 'sc.opening_mileage', 'sc.closing_mileage', 'sc.fuel_amount', 'sc.sch_date', 'sc.vehicle_id', 'sc.public_id', 'dr.first_name', 'dr.last_name', DB::raw('count(*) as trips'), DB::raw('sum(tr.distance) as distance'), DB::raw('sum(tr.trip_amount) as amount'))
                    ->groupBy('sc.schedule_id', 'sc.sch_status', 'sc.opened', 'sc.sc_closed', 'sc.opening_mileage', 'sc.closing_mileage', 'sc.fuel_amount', 'sc.vehicle_id', 'sc.public_id', 'dr.first_name', 'dr.last_name', 'sc.sch_date')
                    ->where('sc.sc_closed', 0)
                    // ->where('tr.completed', 0)
                    ->latest('sc.sch_date')
                    ->paginate(20);

        }elseif(\Gate::allows('isDriver')){
            $sch = DB::table('schedules as sc')
                    ->join('trips as tr', 'sc.schedule_id', '=', 'tr.schedule_id')
                    ->join('drivers as dr', 'tr.driver_id', '=', 'dr.user_id')
                    ->select('sc.schedule_id', 'sc.sch_status', 'sc.opened', 'sc.sc_closed', 'sc.opening_mileage', 'sc.closing_mileage', 'sc.fuel_amount', 'sc.vehicle_id', 'sc.public_id', 'dr.first_name', 'dr.last_name', 'sc.sch_date', DB::raw('count(*) as trips'), DB::raw('sum(tr.distance) as distance'))
                    ->where('dr.user_id', Auth::id())
                    ->groupBy('sc.schedule_id', 'sc.sch_status', 'sc.opened', 'sc.sc_closed', 'sc.opening_mileage', 'sc.closing_mileage', 'sc.fuel_amount', 'sc.vehicle_id', 'sc.public_id', 'dr.first_name', 'dr.last_name', 'sc.sch_date')
                    ->latest('sc.sch_date')
                    ->paginate(20);
        }else{
            $sch = '';
        }

        return response()->json($sch);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function closedSchedules()
    {
        //
        if(\Gate::allows('isAdminOrAccounts')){

            $sch = DB::table('schedules as sc')
                    ->join('trips as tr', 'sc.schedule_id', '=', 'tr.schedule_id')
                    ->join('drivers as dr', 'tr.driver_id', '=', 'dr.user_id')
                    ->join('users as us', 'sc.closed_by', '=', 'us.id')
                    ->select('sc.schedule_id', 'sc.sch_status', 'sc.opened', 'sc.sc_closed', 'sc.opening_mileage', 'sc.closing_mileage', 'sc.fuel_amount', 'sc.sch_date', 'sc.vehicle_id', 'sc.public_id', 'dr.first_name', 'dr.last_name', 'us.name', DB::raw('count(*) as trips'), DB::raw('sum(tr.distance) as distance'), DB::raw('sum(tr.trip_amount) as amount'))
                    ->groupBy('sc.schedule_id', 'sc.sch_status', 'sc.opened', 'sc.sc_closed', 'sc.opening_mileage', 'sc.closing_mileage', 'sc.fuel_amount', 'sc.vehicle_id', 'sc.public_id', 'dr.first_name', 'dr.last_name', 'sc.sch_date', 'us.name')
                    ->where('sc.sc_closed', 1)
                    // ->where('tr.completed', 0)
                    ->latest('sc.sch_date')
                    ->paginate(20);
        }

        return response()->json($sch);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            // 'driver_id' => 'required|exists:drivers,driver_id',
            'opening_mileage' => 'required|numeric',
            'vehicle_id' => 'required|exists:vehicles,vehicle_id',
            'sch_status' => 'required'
        ]);
        $schedule = $request->all();
        //retrieve the driver user ID
        // $user_id = Driver::findOrFail($schedule['driver_id'])->user_id;    

        //check if the current driver has any open schedule        
        $sch = Schedule::where('driver_id', Auth::id())->where('opened', 0)->first();          

        if($sch == null){
            $schedule['created_by'] = Auth::id();
            $schedule['driver_id'] = Auth::id();
            $id = Schedule::create($schedule)->schedule_id;

            $code = str_pad($request->driver_id.''.$id, 6, '0', STR_PAD_LEFT);
            $c = 'SHEET'.$code;
            Schedule::where('schedule_id', $id)->update(['public_id'=>$c]);
            Vehicle::where('vehicle_id', $request['vehicled_id'])->update(['v_open'=> 1]);
            
            return response()->json(['message' => 'The worksheet has been created']);
        }else{
            return response()->json(['error' => 'Sorry, The driver currently has open worksheet']);
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(\Gate::allows('isAdminOrAccounts')){
            
            $trips = DB::table('trips as tr')
                    ->join('drivers as dr','tr.driver_id', '=','dr.user_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->join('schedules as sc', 'tr.schedule_id', '=', 'sc.schedule_id')
                    // ->where('tr.completed', 0)
                    ->where('tr.schedule_id', $id)
                    ->latest('tr.created_at')
                    ->paginate(50);

        }elseif(\Gate::allows('isDriver')){

            $trips = DB::table('trips as tr')
            ->join('drivers as dr','tr.driver_id', '=','dr.user_id')
            ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
            ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
            ->join('schedules as sc', 'tr.schedule_id', '=', 'sc.schedule_id')
            // ->where('tr.completed', 0)
            ->where('tr.schedule_id', $id)
            ->where('sc.driver_id', Auth::id())
            ->latest('tr.created_at')
            ->paginate(50);

        }else{

        }

        return response()->json($trips);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'closing_mileage' => 'required|numeric',
            'fuel_amount' => 'required'
        ]);

        $input = $request->all();
        $sch = Schedule::findOrFail($id);

        $sch->update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function driver($id)
    {
        //
        $sch = Schedule::join('drivers', 'schedules.driver_id', '=', 'drivers.driver_id')
                        ->join('vehicles', 'schedules.vehicle_id', '=', 'vehicles.vehicle_id')
                        ->join('users', 'schedules.created_by', '=', 'users.id')
                        ->where('drivers.driver_id', $id)
                        ->orderBy('schedules.created_at', 'desc')
                        ->paginate(30);

        return response()->json($sch);
    }

    public function closeSchedule(Request $request, $id){
        //receinve the input data
        $input = $request->all();
        //check if there are any open trips not completed;
        

        if(\Gate::allows('isAdminOrAccounts')){
            $tr = Schedule::where('schedule_id', $input['schedule_id'])->where('opened', 0)->first();
            if($tr != NULL){

                return response()->json(['message' => 'FAILED. This worksheet has not been closed by the driver.']);
            }

            $input['sc_closed'] = 1;
            $input['sch_status'] = 'CLOSED';
            $input['closed_by'] = Auth::id();

            $sc = Schedule::findOrFail($input['schedule_id']);
            $sc->update($input);

        }elseif(\Gate::allows('isDriver')){
            $tr = Trip::where('schedule_id', $input['schedule_id'])->where('completed', 0)->first();

            if($tr != NULL){

                return response()->json(['message' => 'FAILED. There are trips not yet closed.']);
            }
            $input['opened'] = 1;
            $input['sch_status'] = 'COMPLETED';

            //update the vehicle status to open
            $v = Vehicle::findOrFail($input['vehicle_id']);
            $v->update(['v_open' => 0]);

            $sch = Schedule::findOrFail($input['schedule_id']);
            $sch->update($input);

        }else{

        }
    }

    public function scheduleList(){

        $return = DB::table('schedules')->where('sc_closed', 1)->get();
        return response()->json($return);
    }

    public function scheduleDetails($id){

        return Schedule::join('drivers', 'schedules.driver_id', '=', 'drivers.user_id')
                ->join('vehicles', 'schedules.vehicle_id', '=', 'vehicles.vehicle_id')
                ->join('structures', 'drivers.commission', '=', 'structures.structure_id')
                ->where('schedules.schedule_id', $id)->first();
    }

   
}
