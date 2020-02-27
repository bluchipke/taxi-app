<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Structure;

class AdministrationController extends Controller
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function structures()
    {
        //
        return Structure::latest()->paginate(20);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function strStore(Request $request)
    {
        //
        $this->validate($request, [
            'str_label' => 'required',
            'str_amount' => 'required|numeric|min:0',
            'str_percent' => 'required|numeric|max:99|min:0',
            'str_status' => 'required',
        ]);

        $str = $request->all();
        Structure::create($str);
        // return $request;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function strShow($id)
    {
        //
        return Structure::find($id);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function strEdit(Request $request, $id)
    {
        //
        $this->validate($request, [
            'str_label' => 'required',
            'str_amount' => 'required|numeric|min:0',
            'str_percent' => 'required|numeric|max:99|min:0',
            'str_status' => 'required',
        ]);

        $str = Structure::findOrFail($id);

        $input = $request->all();
        $str->update($input);
        // return $str;
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
}
