<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Driver;
use DB;
use App\Trip;
use Auth;
use App\User;
use App\Schedule;
use Hash;

class DriverController extends Controller
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
        return Driver::join('users', 'drivers.user_id', '=', 'users.id')->orderBy('users.name', 'asc')->paginate(20);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'driver_email' => 'required|email|unique:users,email',
            'phone_number' => 'required',
            // 'kra_pin' => 'unique:drivers,kra_pin',
            // 'nssf'=> 'unique:drivers,nssf',
            // 'nhif'=> 'unique:drivers,nhif',
            'id_card' => 'required|unique:drivers,id_card',
            'employment_type' => 'required',
            'employment_status' => 'required',
            'gender'=>'required',
            'password'=> 'required|min:6',
            'commission' => 'required',
            'password' => 'required|min:6|same:confirm_password',
        ]);

        $input = $request->all();        
        // return ['message'=>'details saved'];
        $input['role'] = 'driver';
        $input['name'] = $input['first_name'].' '.$input['last_name'];
        $input['email'] = $input['driver_email'];
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $input['user_id'] = $user->id;
        $driver = Driver::create($input);

       
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
        $user = DB::table('drivers as dr')
                    ->join('structures as str','dr.commission', '=','str.structure_id')
                    ->join('users as us', 'dr.user_id', '=', 'us.id')
                    ->where('dr.driver_id', $id)
                    ->first();

        return response()->json($user);
        // return Driver::find($id);

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
            'first_name' => 'required',
            'last_name' => 'required',
            'driver_email' => 'required|email|unique:drivers,driver_email,'.$id.',driver_id',
            'phone_number' => 'required',
            'kra_pin' => 'unique:drivers,kra_pin,'.$id.',driver_id',
            'nssf'=> 'unique:drivers,nssf,'.$id.',driver_id',
            'nhif'=> 'unique:drivers,nhif,'.$id.',driver_id',
            'id_card' => 'unique:drivers,id_card,'.$id.',driver_id',
            'employment_type' => 'required',
            'employment_status' => 'required',
            'gender'=>'required',
            'commission' => 'required',            
            'password' => 'sometimes|min:6|same:confirm_password',
           
        ]);
        
        $driver = Driver::findOrFail($id);
        $input = $request->all();

        // return $input;
        $driver->update($input);

        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user = User::findOrFail($driver->user_id);
        $input['name'] = $input['first_name'].' '.$input['last_name'];
        $input['email'] = $input['driver_email'];
        $user->update($input);
        
        // return $input;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trips($id)
    {
        //
        $user_id = Driver::findOrFail($id)->user_id;

        $trips = DB::table('drivers as dr')
                    ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->where('dr.user_id', $user_id)
                    ->latest('tr.created_at')
                    ->paginate(20);

        return response()->json($trips);
        // return $trips;
    }

     /**
     * Fetch the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function collections($id)
    {
        //
        $user_id = Driver::findOrFail($id)->user_id;

        $colls = DB::table('drivers as dr')
                    ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->join('schedules as sc', 'tr.schedule_id', '=', 'sc.schedule_id')
                    ->where('dr.user_id', $user_id)
                    ->latest('tr.created_at')
                    ->paginate(10);

        return response()->json($colls);
    }

    /**
     * Fetch the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commissions($id)
    {
        //
        $user_id = Driver::findOrFail($id)->user_id;

        $comms = DB::table('drivers as dr')
                    ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->join('schedules as sc', 'tr.schedule_id', '=', 'sc.schedule_id')
                    ->join('structures as st', 'dr.commission', '=', 'st.structure_id')
                    ->where('dr.user_id', $user_id)
                    ->latest('tr.created_at')
                    ->paginate(20);

        return response()->json($comms);
    }

     /**
     * Fetch the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function schedules($id)
    {
        //
        $user_id = Driver::findOrFail($id)->user_id;
        $schs = DB::table('trips as tr')
                    ->join('schedules as sc','tr.schedule_id', '=','sc.schedule_id')
                    ->join('drivers as dr', 'tr.driver_id', '=', 'dr.user_id')
                    ->join('structures as st', 'dr.commission', '=', 'st.structure_id')
                    ->select('sc.schedule_id', 'st.str_percent', 'sc.sch_date', 'sc.public_id', DB::raw('sum(tr.distance) as distance'), DB::raw('sum(tr.toll_fees) as toll'), DB::raw('sum(tr.fuel_expense) as fuel'), DB::raw('sum(tr.trip_misc) as misc'), DB::raw('sum(tr.trip_amount) as amount') )
                    ->groupBy('sc.sch_date', 'sc.public_id', 'sc.schedule_id', 'st.str_percent')
                    ->where('dr.user_id', $user_id)
                    ->latest('sc.created_at')
                    ->paginate(20);

        return response()->json($schs);
    }

    /**
     * Fetch the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function schedule($id)
    {
        //
        // $user_id = Driver::findOrFail($id)->user_id;
        $schs = Schedule::join('drivers', 'schedules.driver_id', '=', 'drivers.user_id')
                ->join('structures', 'drivers.commission', '=', 'structures.structure_id')
                ->where('schedules.driver_id', $id)
                ->first();

        return response()->json($schs);
    }

    /**
     * Fetch the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vehicles($id)
    {
        //
        $user_id = Driver::findOrFail($id)->user_id;

        $schs = DB::table('trips as tr')
                    ->join('schedules as sc','tr.schedule_id', '=','sc.schedule_id')
                    ->join('drivers as dr', 'tr.driver_id', '=', 'dr.user_id')
                    ->join('structures as st', 'dr.commission', '=', 'st.structure_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->select('vc.vehicle_id', 'vc.number_plate', 'st.str_percent', DB::raw('count(*) as trips'), DB::raw('sum(tr.distance) as distance'), DB::raw('sum(tr.toll_fees) as toll'), DB::raw('sum(tr.fuel_expense) as fuel'), DB::raw('sum(tr.trip_misc) as misc'), DB::raw('sum(tr.trip_amount) as amount') )
                    ->groupBy('vc.vehicle_id', 'vc.number_plate', 'st.str_percent')
                    ->where('dr.user_id', $user_id)
                    ->latest('sc.created_at')
                    ->paginate(20);

        return response()->json($schs);
    }

    /**
     * Find the specified resource.
     *
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        //
       if($search = \Request::get('q')){
            $vs = Vehicle::where(function($query) use ($search){
                $query->where('number_plate', 'LIKE', '%'.$search.'%')
                      ->orWhere('make', 'LIKE', '%'.$search.'%')
                      ->orWhere('policy_number', 'LIKE', '%'.$search.'%');
            })->paginate(5);
       }else{
           $vs = Vehicle::latest()->paginate(5);
       }

       return $vs;
    }

     /**
     * Retrieve the number of trips by current user.
     */
    public function currentTrips(){

        // $id = User::find(Auth::id)
        $trips = Trip::select(DB::raw('count(*) as trips'))->where('driver_id', Auth::id())->where('completed', 0)->get();

        return $trips[0]['trips'];

        // return $trips;
    }


}
