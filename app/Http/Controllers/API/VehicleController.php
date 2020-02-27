<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vehicle;
use Auth;

class VehicleController extends Controller
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
        return Vehicle::latest()->paginate(5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function openVehicles()
    {
        //
        return Vehicle::where('v_open', 0)->latest()->paginate(5);
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
                'number_plate' => 'required',
                'make' => 'required',
                'model' => 'required',
                'color' => 'required',
                'body' => 'required',
                'mileage' => 'numeric',
                'capacity' => 'numeric',
                'seating' => 'required|numeric',
                'engine_number' => 'unique:vehicles,engine_number',
                'policy_number' => 'unique:vehicles,policy_number'
        ]);

        $input = $request->all();
        $vehicle = Vehicle::create($input);

        return $vehicle;
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
        return Vehicle::find($id);
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
                'number_plate' => 'required',
                'make' => 'required',
                'model' => 'required',
                'color' => 'required',
                'body' => 'required',
                'mileage' => 'numeric',
                'capacity' => 'numeric',
                'engine_number' => 'unique:vehicles,engine_number,'.$id.',vehicle_id',
                'policy_number' => 'unique:vehicles,policy_number,'.$id.',vehicle_id',
                'insurance_expiry' => 'required'
        ]);
        $v = Vehicle::findOrFail($id);
        
        $input = $request->all();
        $v->update($input);

        return ['message'=>'Update successful'];
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
        $v = Vehicle::findOrFail($id);

        $v->delete();
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listVehicles()
    {
        //
        return Vehicle::select('vehicle_id', 'number_plate')->orderBy('number_plate', 'asc')->get();
    }

      /**
     * Get the current vehicle being used by the driver.
     *
     * @return \Illuminate\Http\Response
     */
    public function currentVehicle()
    {
        //
        return Vehicle::join('schedules', 'vehicles.vehicle_id', '=', 'schedules.vehicle_id')
                    ->select('schedules.vehicle_id', 'vehicles.number_plate')
                    ->where('schedules.driver_id', '=', Auth::id())
                    ->where('schedules.opened', '=', 0)
                    ->first();
    }
}
