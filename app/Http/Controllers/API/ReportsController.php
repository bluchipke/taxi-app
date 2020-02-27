<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ReportsController extends Controller
{
      /**
     * Create a new controller innstance
     */
    public function __construct(){

        $this->middleware('auth:api');

    }
    
    //
    public function driverCommissions(Request $request){

        $input = $request->all();

        
        $id = $input['user_id']['user_id'];
        $date1 = $input['date1'];
        $date2 = $input['date2'];
        // return $input;
        if($id != null){

        $colls = DB::table('drivers as dr')
                ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                ->join('schedules as sc', 'tr.schedule_id', '=', 'sc.schedule_id')
                ->join('structures as st', 'dr.commission', '=', 'st.structure_id')
                ->where('dr.user_id', $id)
                ->where('tr.trip_date', '>=', $date1)
                ->where('tr.trip_date', '<=', $date2)
                ->where('tr.completed', 1)
                ->latest('tr.created_at')
                ->paginate(10);
        }else{

            $colls = DB::table('drivers as dr')
                ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                ->join('schedules as sc', 'tr.schedule_id', '=', 'sc.schedule_id')
                ->join('structures as st', 'dr.commission', '=', 'st.structure_id')
                ->where('tr.trip_date', '>=', $date1)
                ->where('tr.trip_date', '<=', $date2)
                ->where('tr.completed', 1)
                ->latest('tr.created_at')
                ->paginate(10);

        }
        return response()->json($colls);
    }

    public function clientReports($id, $date1, $date2){
        // $input = $request->all();

        // $date1 = $input['date1'];
        // $date2 = $input['date2'];
        // $client_id = $input['user_id']['client_id'];

        if($id != 0){

            $colls = DB::table('drivers as dr')
                    ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->join('schedules as sc', 'tr.schedule_id', '=', 'sc.schedule_id')
                    ->join('structures as st', 'dr.commission', '=', 'st.structure_id')
                    ->where('rg.client_id', $id)
                    ->where('tr.trip_date', '>=', $date1)
                    ->where('tr.trip_date', '<=', $date2)
                    ->where('tr.completed', 1)
                    ->latest('tr.created_at')
                    ->paginate(10);
            }else{
    
                $colls = DB::table('drivers as dr')
                    ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->join('schedules as sc', 'tr.schedule_id', '=', 'sc.schedule_id')
                    ->join('structures as st', 'dr.commission', '=', 'st.structure_id')
                    ->where('tr.trip_date', '>=', $date1)
                    ->where('tr.trip_date', '<=', $date2)
                    ->where('tr.completed', 1)
                    ->latest('tr.created_at')
                    ->paginate(10);
    
            }
            return response()->json($colls);

    }

    public function driverCommissionsSummary2(Request $request){
        $input = $request->all();
        $date1 = $input['date1'];
        $date2 = $input['date2'];
        $id = $client_id = $input['user_id']['user_id'];
        return $input;

        $colls = DB::table('drivers as dr')
                    ->join('trips as tr','dr.user_id', '=','tr.driver_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->join('schedules as sc', 'tr.schedule_id', '=', 'sc.schedule_id')
                    ->join('structures as st', 'dr.commission', '=', 'st.structure_id')
                    ->select('dr.driver_id', 'dr.first_name', 'dr.last_name', DB::raw('count(*) as trips'), DB::raw('sum(tr.distance) as distance'), DB::raw('sum(tr.toll_fees) as toll'), DB::raw('sum(tr.fuel_expense) as fuel'), DB::raw('sum(tr.trip_misc) as misc'), DB::raw('sum(tr.trip_amount) as amount'))
                    ->where('tr.trip_date', '>=', $date1)
                    ->where('tr.trip_date', '<=', $date2)
                    ->where('tr.completed', 1)
                    ->groupBy('dr.driver_id', 'dr.first_name', 'dr.last_name')
                    // ->latest('dr.created_at')
                    ->orderBy('dr.first_name', 'asc')
                    ->paginate(10);
    
        return response()->json($colls);


    }

    public function driverCommissionsSummary($user_id, $date1, $date2){

        // $input = $request->all();
        // $date1 = $input['date1'];
        // $date2 = $input['date2'];
        // $user_id = $input['user_id']['user_id'];

        if($user_id != 0){

            $data = DB::table('trips as tr')
                ->join('schedules as sc','tr.schedule_id', '=','sc.schedule_id')
                ->join('drivers as dr', 'tr.driver_id', '=', 'dr.user_id')
                ->join('structures as st', 'dr.commission', '=', 'st.structure_id')
                ->select('sc.schedule_id', 'st.str_percent', 'sc.sch_date', 'sc.public_id', 'sc.fuel_amount', 'sc.opening_mileage', 'sc.closing_mileage', DB::raw('count(*) as trips'), DB::raw('sum(tr.distance) as distance'), DB::raw('sum(tr.toll_fees) as toll'), DB::raw('sum(tr.fuel_expense) as fuel'), DB::raw('sum(tr.trip_misc) as misc'), DB::raw('sum(tr.trip_amount) as trip_amount') )
                ->groupBy('sc.sch_date', 'sc.public_id', 'sc.schedule_id', 'st.str_percent', 'sc.fuel_amount', 'sc.opening_mileage', 'sc.closing_mileage')
                ->where('sc.sch_date', '>=', $date1)
                ->where('sc.sch_date', '<=', $date2)
                ->where('dr.user_id', $user_id)
                ->where('sc.sc_closed', 1)
                ->latest('sc.created_at')
                ->paginate(20);
        }else{
            $data = DB::table('trips as tr')
                ->join('schedules as sc','tr.schedule_id', '=','sc.schedule_id')
                ->join('drivers as dr', 'tr.driver_id', '=', 'dr.user_id')
                ->join('structures as st', 'dr.commission', '=', 'st.structure_id')
                ->select('sc.schedule_id', 'st.str_percent', 'sc.sch_date', 'sc.public_id', 'sc.fuel_amount', 'sc.opening_mileage', 'sc.closing_mileage', DB::raw('count(*) as trips'), DB::raw('sum(tr.distance) as distance'), DB::raw('sum(tr.toll_fees) as toll'), DB::raw('sum(tr.fuel_expense) as fuel'), DB::raw('sum(tr.trip_misc) as misc'), DB::raw('sum(tr.trip_amount) as trip_amount') )
                ->groupBy('sc.sch_date', 'sc.public_id', 'sc.schedule_id', 'st.str_percent', 'sc.fuel_amount', 'sc.opening_mileage', 'sc.closing_mileage')
                ->where('sc.sch_date', '>=', $date1)
                ->where('sc.sch_date', '<=', $date2)
                ->where('sc.sc_closed', 1)
                ->latest('sc.created_at')
                ->paginate(20);
        }

        return response()->json($data);
    }

    public function worksheetDetails($id){

        // $input = $request->all();
        // $id = $input['schedule_id']['schedule_id'];

        if($id == NULL){
            exit();
        }
        $trips = DB::table('trips as tr')
                    ->join('drivers as dr','tr.driver_id', '=','dr.user_id')
                    ->join('organizations as rg', 'rg.client_id', '=', 'tr.organization_id')
                    ->join('vehicles as vc', 'tr.vehicle_id', '=', 'vc.vehicle_id')
                    ->join('schedules as sc', 'tr.schedule_id', '=', 'sc.schedule_id')
                    // ->where('tr.completed', 0)
                    ->where('tr.schedule_id', $id)
                    ->latest('tr.created_at')
                    ->paginate(50);

        return response()->json($trips);
    }

    public function invoiceReports($id){
        $invoice = DB::table('trips as tr')
                ->join('invoices as in', 'tr.invoice_id', '=', 'in.invoice_id')
                ->join('organizations as cl', 'in.client_id', '=', 'cl.client_id' )
                ->where('tr.invoice_id', $id)
                ->latest('tr.trip_date')
                ->paginate(100);

        return response()->json($invoice);
    }

    public function sortableInvoice($client_id, $date1, $date2){

      if(\Gate::allows('isAdminOrAccounts'))
      {
        if($client_id != 0){
            
            $inv = DB::table('invoices as in')
                ->join('trips as tr', 'in.invoice_id', '=', 'tr.invoice_id')
                ->select('in.invoice_id', 'in.invoice_no', 'in.created_date', 'in.payment_status', DB::raw('sum(tr.trip_amount) as amount'), DB::raw('count(*) as trips'))
                ->groupBy('in.invoice_id', 'in.invoice_no', 'in.created_date', 'in.payment_status')                
                ->where('in.client_id', $client_id)
                ->where('in.created_date', '>=', $date1)
                ->where('in.created_date', '<=', $date2)
                ->latest('in.created_date')
                ->paginate(100);

            }else{
                
                $inv = DB::table('invoices as in')
                    ->join('trips as tr', 'in.invoice_id', '=', 'tr.invoice_id')
                    ->select('in.invoice_id', 'in.invoice_no', 'in.created_date', 'in.payment_status', DB::raw('sum(tr.trip_amount) as amount'), DB::raw('count(*) as trips'))
                    ->groupBy('in.invoice_id', 'in.invoice_no', 'in.created_date', 'in.payment_status')                
                    // ->where('in.client_id', $client_id)
                    ->where('in.created_date', '>=', $date1)
                    ->where('in.created_date', '<=', $date2)
                    ->latest('in.created_date')
                    ->paginate(100);
            }
        }               
                
        return response()->json($inv);

    }

    public function clientInvoices(){

        if(\Gate::allows('isClient')){

            $inv = DB::table('invoices as in')
            ->join('trips as tr', 'in.invoice_id', '=', 'tr.invoice_id')
            ->select('in.invoice_id', 'in.invoice_no', 'in.created_date', 'in.payment_status', DB::raw('sum(tr.trip_amount) as amount'), DB::raw('count(*) as trips'))
            ->groupBy('in.invoice_id', 'in.invoice_no', 'in.created_date', 'in.payment_status')                
            ->where('in.client_id', Auth::id())
            ->latest('in.created_date')
            ->paginate(100);
        }else{
            $inv = '';
        }

        return response()->json($inv);
    }
}
