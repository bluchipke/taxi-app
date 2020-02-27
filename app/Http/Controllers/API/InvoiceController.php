<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use Auth;
use DB;
use App\Organization;

class InvoiceController extends Controller
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
        $client_id = Organization::where('login_id', Auth::id())->first()->client_id;
        if(\Gate::allows('isClient')){

            $inv = DB::table('invoices as in')
            ->join('trips as tr', 'in.invoice_id', '=', 'tr.invoice_id')
            ->select('in.invoice_id', 'in.invoice_no', 'in.created_date', 'in.payment_status', DB::raw('sum(tr.trip_amount) as amount'), DB::raw('count(*) as trips'))
            ->groupBy('in.invoice_id', 'in.invoice_no', 'in.created_date', 'in.payment_status')                
            ->where('in.client_id', $client_id)
            ->latest('in.created_date')
            ->paginate(100);
        }else{
            $inv = '';
        }

        return response()->json($inv);
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
        
        $input = $request->all();
        $input['created_by'] = Auth::id();
        $input['created_date'] = date('Y-m-d');
        $ids = $request->trip_ids;
        $invoice_id = Invoice::create($input)->invoice_id;
        $invoice_no = str_pad($invoice_id, 6, '0', STR_PAD_LEFT);
        Invoice::where('invoice_id', $invoice_id)->update(['invoice_no' => $invoice_no]);

        for($i=0; $i<count($ids); $i++){
            DB::table('trips')->where('trip_id', $ids[$i])->update(['invoiced' => 1, 'invoice_id' => $invoice_id]);
        }

        return response()->json(['invoice_id' => $invoice_id]);
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
        return Invoice::join('organizations as cm', 'invoices.client_id', '=', 'cm.client_id')->where('invoices.invoice_id', $id)->first();
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
