<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class UserController extends Controller
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
        return User::where('role', '!=', 'driver')
                    ->where('role', '!=', 'client')
                    ->latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6|same:confirm_password',
            'role' => 'required'
        ]);
        
        $input = $request->all();
        $input['password'] = Hash::make($request['password']);
        $user = User::create($input);
        // $user = User::create([

        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'password' => Hash::make($request['password'])
        // ]);

        // return $user;
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|min:6|unique:users,email,'.$id,
            'password' => 'sometimes|same:confirm_password',
            'role' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }


        $user = User::find($id);
        $user->update($input);
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
        $user = User::findOrFail($id);
        $user->delete();
    }

    /**
     * Retrieve the current user information, if pending trip not completed.
     */
    public function currentUser(){

        // $id = User::find(Auth::id)
        $trips = Trip::select(DB::raw('count(*) as trips'))->where('driver_id', Auth::id())->where('completed', 0)->get();

        // $no = $trips->trips;

        return $trips;
    }
}
