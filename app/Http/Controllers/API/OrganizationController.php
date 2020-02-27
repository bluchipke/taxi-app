<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Organization;
use DB;
use Auth;
use Hash;
use App\User;

class OrganizationController extends Controller
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

            $clients = Organization::orderBy('client_desc', 'asc')->get();

        }elseif(\Gate::allows('isClient')){

            $clients = Organization::where('login_id', Auth::id())->first();
        }else{
            $client = '';
        }

        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the incoming requests
        $this->validate($request, [
            'client_desc' => 'required',
            'client_phone' => 'required',
            'client_email' => 'required|email|unique:users,email',
            'client_status' => 'required',
            'client_pin' => 'required|unique:organizations,client_pin',
            'tax_rate' => 'required|min:0',
            'password' => 'required|min:6|same:confirm_password'
        ]);

        $input = $request->all();
        $input['email'] = $input['client_email'];
        $input['name'] = $input['client_desc'];
        $input['password'] = Hash::make($input['password']);
        $input['role'] = 'client';

        $user_id = User::create($input)->id;
        $input['login_id'] = $user_id;
        $data = Organization::create($input);

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
        return Organization::find($id);
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
        //validate the incoming requests
        $this->validate($request, [
            'client_desc' => 'required',
            'client_phone' => 'required',
            'client_email' => 'required|email|unique:organizations,client_email,'.$id.',client_id',
            'client_status' => 'required',
            'client_pin' => 'required|unique:organizations,client_pin,'.$id.',client_id',
            'tax_rate' => 'required|min:0',
            'password' => 'sometimes|min:6|same:confirm_password'
        ]);

        $client = Organization::findOrFail($id);
        $user = User::findOrFail($client->login_id);

        $input = $request->all();

        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }
        $input['email'] = $input['client_email'];
        $input['name'] = $input['client_desc'];

        $user->update($input);
        $client->update($input);
       
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
        $org = Organization::findOrFail($id);

        $org->delete();

        return ['message'=> 'Deletion successfull'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientList()
    {
        //
        $clients =  DB::table('organizations')->select('client_id', 'client_desc')->orderBy('client_desc', 'asc')->get();

        return response()->json($clients);
    }
}
