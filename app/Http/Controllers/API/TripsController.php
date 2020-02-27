<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trip;
use App\Schedule;
use Auth;
use DB;
use App\Organization;

class TripsController extends Controller
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
            $trips = DB::table('drivers as dr')
                    ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    // ->where('tr.closed', 0)
                    ->latest('tr.created_at')
                    ->paginate(50);
        
        }
        elseif(\Gate::allows('isDriver')){
            $trips = DB::table('drivers as dr')
                    ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->where('dr.user_id', Auth::id())
                    ->latest('tr.created_at')
                    ->paginate(20);
        }elseif(\Gate::allows('isClient')){
            $client_id = Organization::where('login_id', Auth::id())->first()->client_id;

            $trips = DB::table('drivers as dr')
                    ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->where('rg.client_id', $client_id)
                    ->latest('tr.created_at')
                    ->paginate(20);
        }else{

        }

        return response()->json($trips);
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
            'client_name' => 'required',
            'organization_id' => 'required',
            'start_point' => 'required',
            'mileage_out' => 'required|integer|min:0',
            // 'mileage_in' => 'numeric|min:0',
            // 'distance' => 'numeric',
            'time_out' => 'required'
        ]);

        $sch = Schedule::where('driver_id', Auth::id())->where('opened', 0)->first();
        $last_trip = Trip::where('driver_id', Auth::id())->latest()->first();

        $id = $sch->schedule_id;        
        $input = $request->all();
        
        $input['trip_status'] = 'IN PROGRESS';
        $input['trip_date'] = date('Y-m-d');
        $input['driver_id'] = Auth::id();
        $input['schedule_id'] = $id;
        $input['organization_id'] = $request['organization_id']['client_id'];
        $input['completed'] = 0;

        // return $input;
        $trip = Trip::create($input);
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
         //
         $this->validate($request, [
            'client_name' => 'required',
            'organization_id' => 'required',
            'start_point' => 'required',
            'mileage_out' => 'required|numeric|min:0',
            'mileage_in' => 'required|numeric|min:0',
            'time_in' => 'required',
            'toll_fees' => 'numeric|min:0',
            'trip_misc' => 'numeric|min:0',
            'time_out' => 'required'
        ]);

        $input = $request->all();

        if($input['mileage_in'] < $input['mileage_out']){

            return ['message' => 'Failed. Mileage in must be greater than mileage out.'];

        }else{
            $input['distance'] = $input['mileage_in'] - $input['mileage_out'];
            $trip = Trip::findOrFail($id);
            $trip->update($input);
            return ['message' => 'Trip update was successfull.'];
        }
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
     * Return the number of trips the driver/drivers
     */
    public function totalTrips(){

    }

    /**
     * Driver complete trip
     */
    public function completeTrip($id){

        $trip = Trip::findOrFail($id);
        if($trip->mileage_in == NULL){

            return ['message' => 'Enter the mileage in before you complete trip'];
        }elseif($trip->mileage_in < $trip->mileage_out){

            return ['message' => 'The mileage in must be greater than mileage out'];
        }else{

            $trip->update([
                'completed' => 1,
                'trip_status' => 'COMPLETED'
            ]);

            return ['message' => 'Trip completed.'];
        }
        
    }

    /**
     * Admin close trips
     */
    public function closeTrip($id){

        $trip = Trip::findOrFail($id);
        if($trip->mileage_in == NULL || $trip->trip_amount == NULL || $trip->payment_method == NULL){

            return ['message' => 'FAILED: Payment information missing.'];
        }elseif($trip->completed == 0)
        {
            return ['message' => 'FAILED: Trip not yet completed.'];
        }else{

            $trip->update([
                'closed' => 1,
                'trip_status' => 'CLOSED'
            ]);

            return ['message' => 'Trip completed.'];
        }
        
    }

    /**
     * Reopen trips
     */
    public function reopenTrip($id){

        $trip = Trip::findOrFail($id);
        if($trip->mileage_in == NULL || $trip->trip_amount == NULL || $trip->payment_method == NULL){

            return ['message' => 'Some entries missing. Fill all details to complete'];
        }elseif($trip->completed == 0)
        {
            return ['message' => 'Trip Not Yet Completed.'];
        }else{

            $trip->update([
                'closed' => 0,
                'trip_status' => 'COMPLETED'
            ]);

            return ['message' => 'Trip completed.'];
        }
        
    }
}
