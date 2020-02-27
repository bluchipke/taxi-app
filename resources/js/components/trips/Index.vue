<template>
    <div class="contai">        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">                             
                            <div class="col-md-7">
                                <h5>CURRENT TRIPS</h5>
                            </div>
                            <div class="col-md-3">
                                <!-- SEARCH FORM -->
                                <div class="form-inline ml-3">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" v-model="vsearch" @keyup="searchV" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <router-link :to="'/driver/start/trip'" class="btn btn-xs btn-flat btn-primary btn-block" v-show="$gate.isDriver()">START TRIP</router-link>
                            </div>                  
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Date:</th>
                                    <th v-show="!$gate.isDriver()">Driver</th>
                                    <th>Car</th>
                                    <th>Client</th>
                                    <th v-show="!$gate.isClient()">Organization:</th>
                                    <th>Pickup:</th>
                                    <th>Destination</th>
                                    <th v-show="$gate.isClient()">Time Out</th>
                                    <th >Status</th>     
                                    <th v-show="!$gate.isClient()">Action</th>                               
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in trips.data" :key="d.trip_id">
                                    <td>{{++index}}</td>
                                    <td v-show="!$gate.isClient()"> <a href="#" @click.prevent="showItem(d)">{{d.trip_date}}</a> </td>
                                    <td v-show="$gate.isClient()"> <a href="#" @click.prevent="showDetails(d)">{{d.trip_date}}</a> </td>
                                    <td v-show="!$gate.isDriver()">{{d.first_name+' '+d.last_name}}</td>
                                    <td>{{d.number_plate}}</td>
                                    <td>{{d.client_name}}</td>
                                    <td :title="d.client_desc" v-show="!$gate.isClient()">{{d.client_desc }}</td>
                                    <td :title="d.start_point">{{d.start_point | truncate(20)}}</td>
                                    <td :title="d.end_point">{{d.end_point | truncate(20)}}</td>
                                    <td :title="d.time_out" v-show="$gate.isClient()">{{d.time_out}}</td>
                                    <td> <a href="#">{{d.trip_status}}</a> </td>
                                    <td v-show="d.completed == 0 && $gate.isDriver()"><a href="#" @click.prevent="completeTrip(d.trip_id)"><i class="fa fa-folder-open fa-2x" title="OPEN"></i></a> </td>
                                    <td v-show="d.completed == 1 && $gate.isDriver()"><a href="#" ><i class="fa fa-folder fa-2x" title="COMPLETED"></i></a> </td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="trips" @pagination-change-page="getResults"></pagination>
                    </div>
                    <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                        Launch Default Modal
                    </button> -->
                </div>
            </div>
        </div>    
        <!-- modal window for updating content --> 
           <div class="modal fade show" id="modal-default" style="display: none;" aria-modal="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">EDIT TRIP</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form @submit.prevent="updateTrip" @keydown="form.onKeydown($event)" class="form-horizontal"> 
                            <div class="modal-body">
                                <!-- modal body start -->                                               
                                        <!-- <div class="row"> -->
                                            <!-- <div class="col-md-9"> -->
                                                <!-- <fieldset> -->
                                                    <!-- <legend> -->
                                                   <div v-show="$gate.isAdminOrDriver()">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5>Trip Information</h5>
                                                                <hr>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >Client Name:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" v-model="form.client_name" name="client_name" class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('client_name') }">
                                                                    <has-error :form="form" field="client_name"></has-error>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >Organization:</label>
                                                            <div class="col-md-9">
                                                                <select v-model="form.organization_id"  name="organization_id" class="form-control"  :class="{ 'is-invalid': form.errors.has('organization_id') }">
                                                                    <option v-for="client in clients" :value="client.client_id" :key="client.client_id">{{client.client_desc}}</option>
                                                                </select>
                                                                    <has-error :form="form" field="organization_id"></has-error>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >From:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" v-model="form.start_point" name="start_point" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('start_point') }">
                                                                    <has-error :form="form" field="start_point"></has-error>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >To:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" v-model="form.end_point" name="end_point" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('end_point') }">
                                                                    <has-error :form="form" field="end_point"></has-error>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >Vehicle:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" v-model="form.number_plate" name="number_plate" class="form-control form-control-sm" readonly >
                                                                    <!-- <has-error :form="form" field="vehicle_id"></has-error> -->
                                                                </div>
                                                        </div> 
                                                    <!-- </fieldset> -->
                                                <!-- </div> -->
                                                <!-- <div class="col-md-9"> -->
                                                    <!-- <fieldset> -->
                                                        <!-- <legend> -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5>Pickup Details</h5>
                                                                <hr>
                                                            </div>
                                                        </div>                                                       
                                                            <!-- </legend>   -->                                                                                     
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >Mileage Out:</label>
                                                            <div class="col-md-9">
                                                                <input type="number" v-model="form.mileage_out" name="mileage_out" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('mileage_out') }">
                                                                    <has-error :form="form" field="mileage_out"></has-error>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >Time Out:</label>
                                                            <div class="col-md-9">
                                                                <datetime format="H:i:s" width="100%" v-model="form.time_out" name="time_out" :class="{ 'is-invalid': form.errors.has('time_out') }"></datetime>
                                                                    <has-error :form="form" field="time_out"></has-error>
                                                            </div>
                                                        </div>     
                                                        <!-- Destination details  -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5>Destination Details</h5>
                                                                <hr>
                                                            </div>
                                                        </div>                                                       
                                                            <!-- </legend>   -->                                                                                     
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >Mileage In:</label>
                                                            <div class="col-md-9">
                                                                <input type="number" v-model="form.mileage_in" name="mileage_in" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('mileage_in') }">
                                                                    <has-error :form="form" field="mileage_in"></has-error>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >Time In:</label>
                                                            <div class="col-md-9">
                                                                <datetime format="H:i:s" width="100%" v-model="form.time_in" name="time_out" :class="{ 'is-invalid': form.errors.has('time_in') }"></datetime>
                                                                    <has-error :form="form" field="time_in"></has-error>
                                                            </div>
                                                        </div>  
                                                        <!-- Expenses  -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                    <h5>Trip Expenses</h5>
                                                                <hr>
                                                            </div>
                                                        </div>                                                       
                                                            <!-- </legend>   -->                                                                                     
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >Toll Fees:</label>
                                                                <div class="col-md-9">
                                                                <input type="number" v-model="form.toll_fees" name="toll_fees" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('toll_fees') }">
                                                                    <has-error :form="form" field="toll_fees"></has-error>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >Fuel Expense:</label>
                                                                <div class="col-md-9">
                                                                <input type="number" v-model="form.fuel_expense" name="fuel_expense" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('fuel_expense') }">
                                                                    <has-error :form="form" field="fuel_expense"></has-error>
                                                            </div>
                                                        </div> -->
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-3" >Miscellaneous:</label>
                                                                <div class="col-md-9">
                                                                <input type="number" width="100%" v-model="form.trip_misc" name="trip_misc" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('trip_misc') }">
                                                                    <has-error :form="form" field="trip_misc"></has-error>
                                                            </div>
                                                        </div>  
                                                   </div>
                                                    

                                                    <!-- Accounting details  -->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                             <h5>Accounting Info</h5>
                                                            <hr>
                                                        </div>
                                                    </div>                                                       
                                                        <!-- </legend>   -->                                                                                     
                                                    <div class="form-group row">
                                                        <label for="" class="form-label col-md-3" >Payment Method:</label>
                                                         <div class="col-md-9">
                                                            <select v-model="form.payment_method" name="payment_method" class="form-control" :class="{ 'is-invalid': form.errors.has('payment_method') }">
                                                                <option value="CASH">CASH</option>
                                                                <option value="MPESA CODE">MPESA</option>
                                                                <option value="VOUCHER NUMBER">VOUCHER</option>
                                                            </select>
                                                                <has-error :form="form" field="payment_method"></has-error>
                                                        </div>
                                                    </div>
                                                     <div class="form-group row">
                                                        <label for="" class="form-label col-md-3" style="text-transform: capitalize;">Txn Code</label>
                                                         <div class="col-md-9">
                                                            <input type="text" v-model="form.payment_code" name="payment_code" id="payment_code" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('payment_code') }">
                                                                <has-error :form="form" field="payment_code"></has-error>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="form-label col-md-3" >Payment Amount:</label>
                                                         <div class="col-md-9">
                                                            <input type="number" width="100%" v-model="form.trip_amount" name="trip_amount" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('trip_amount') }">
                                                                <has-error :form="form" field="trip_amount"></has-error>
                                                        </div>
                                                    </div>  

                                                    
                                                <!-- </fieldset> -->
                                            <!-- </div>                                            -->
                                        <!-- </div> -->
                                                                        
                                <!-- modal body end -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" type="submit"  class="btn btn-sm btn-success" v-show="this.form.completed == 0 || $gate.isAdminOrAccounts() && this.form.closed != 1"><i class="fa fa-check"></i> UPDATE</button>
                                <!-- <button :disabled="form.busy" type="submit" class="btn btn-sm btn-primary" v-show="this.form.completed == 0 && $gate.isDriver()" @click.prevent="completeTrip(this.form.trip_id)">COMPLETE</button> -->
                                <a href="#" title="Updating Unavailable" class="btn btn-sm btn-flat btn-warning" v-show="this.form.completed == 1 && $gate.isDriver()">TRIP COMPLETED</a>
                                <a href="#" title="Updating Unavailable" class="btn btn-sm btn-flat btn-warning" v-show="this.form.closed == 1 && $gate.isAdminOrAccounts()">TRIP CLOSED</a>
                                <button :disabled="form.busy" type="submit"  class="btn btn-sm btn-danger" @click.prevent="closeTrip" v-show="this.form.closed == 0 && $gate.isAdminOrAccounts()"><i class="fa fa-lock"></i> CLOSE</button>
                                <button :disabled="form.busy" type="submit"  class="btn btn-sm btn-danger" @click.prevent="reopenTrip" v-show="this.form.closed == 1 && $gate.isAdmin()"><i class="fa fa-lock"></i> OPEN</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
         <!-- end of modal-->
         <!-- modal box preview trip -->
            <div class="modal fade" id="modal-trip">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">TRIP DETAILS: <span style="color: #4f8ac7;">{{trip.client_name}}</span> </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>                        
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary">                                                                       
                                    <div class="box-body"> 
                                        <h5 style="color: #4f8ac7;">{{trip.trip_status}}</h5>
                                        <hr>
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td><strong><i class="fa fa-tag "></i> Driver:</strong>
                                                        {{trip.first_name+ ' ' +trip.last_name}}
                                                    </td>
                                                    <td>
                                                        <strong><i class="fa fa-taxi "></i> Vehicle:</strong>
                                                        {{trip.number_plate}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong><i class="fa fa-map-marker "></i> Pickup:</strong>
                                                        {{trip.start_point}}
                                                    </td>
                                                    <td>
                                                        <strong><i class="fa fa-map-marker "></i> Drop Off:</strong>
                                                        {{trip.end_point}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong><i class="fa fa-clock "></i> Time Out:</strong>
                                                        {{trip.time_out}}
                                                    </td>
                                                    <td>
                                                        <strong><i class="fa fa-clock "></i> Time In:</strong>
                                                        {{trip.time_in}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong><i class="fa fa-road "></i> Distance:</strong>
                                                        {{trip.distance | numFormat('0,0.0')}} KMS
                                                    </td>
                                                    <td>
                                                        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <h5>CHARGES</h5>
                                        <hr>
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Payment Method: </td>
                                                    <td><span style="text-align: right;">{{trip.payment_method}}</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Trxn Code: </td>
                                                    <td><span style="text-align: right;">{{trip.payment_code}}</span></td>
                                                </tr>
                                                <tr>
                                                    <td><h6>Amount: </h6></td>
                                                    <td><h6><span style="text-align: right;">KES {{trip.trip_amount | numFormat('0,0.00')}}</span></h6></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
    </div>    
</template>
<script>
export default {
    components:{
        datetime,
    },
    data() {
        return {
            trips: {},
            clients: [],            
            driver_id: this.$route.params.id,
            vsearch: '',
            selected: '',
            trip:{},
            form: new Form({
                trip_id: '',
                created_date: '',
                client_name: '',
                organization_id: '',
                start_point: '',
                end_point: '',
                mileage_out: '',
                mileage_in: '',
                vehicle_id: '',
                vehicle: '',
                time_out: '',
                time_in: '',
                distance: '',
                schedule_id: '',
                total_time: '',
                number_plate: '',
                payment_method: '',
                payment_code: '',
                trip_amount: '',
                toll_fees: '',
                trip_misc: '',
                fuel_expense:'',
                completed: '',
                closed: ''
            })
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/trips?page=' + page)
				.then(response => {
					this.trips = response.data;
				});
		},
        getTrips(){
            axios.get('api/trips').then(({ data})=>(this.trips = data));
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.trips = data
            ))
            .catch(()=>{

            })
            
        },
        showItem(d){
            this.form.reset();
            $('#modal-default').modal('show');
            this.getClients();
            // this.getVehicle();
            // console.log(d);
            this.form.fill(d);
        },
        showDetails(d){
            // this.form.reset();
            $('#modal-trip').modal('show');
            this.trip = d;
            // this.getClients();
            // this.getVehicle();
            // console.log(d);
            // this.form.fill(d);
        },
        updateTrip(){
            this.$Progress.start();
            this.form.put('api/trips/'+this.form.trip_id)
            .then((data)=>{
                Toast.fire({
                    type: 'success',
                    title: data.data.message
                })
                $('#modal-default').modal('hide');
                this.getTrips();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Trip details failed to save'
                })
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        completeTrip(id){
            this.form.put('api/trips/complete/'+id)
            .then((data)=>{
                Toast.fire({
                    type: 'success',
                    title: data.data.message
                })
                this.getTrips();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Unkown error occurred'
                })
            })
        },
        closeTrip(){
            this.form.put('api/trips/close/'+this.form.trip_id)
            .then((data)=>{
                Toast.fire({
                    type: 'success',
                    title: data.data.message
                })
                $('#modal-default').modal('hide');
                this.getTrips();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Unkown error occurred'
                })
            })
        },
          reopenTrip(){
            this.form.put('api/trips/reopen/'+this.form.trip_id)
            .then((data)=>{
                Toast.fire({
                    type: 'success',
                    title: data.data.message
                })
                $('#modal-default').modal('hide');
                this.getTrips();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Unkown error occurred'
                })
            })
        },
        getClients(){
             axios.get('api/clients/list').then(({ data})=>(
                 this.clients = data
                //  this.form.organization_id = data
            ));
        },
        changePayment(){
            // this.selected = this.form.payment_method;
            // if(this.form.payment_method = 'CASH'){
            //     $('#payment_code').hide();
            // }else{
            //     $('#payment_code').show();
            // }
        },
        // getVehicle(){
        //      axios.get('api/vehicle/schedule').then(({ data})=>(
        //          this.form.vehicle = data.number_plate
        //         //  this.form.vehicle_id = data.vehicle_id
        //     ));
        // }
    },
    created(){
        this.$Progress.start();
        this.getTrips();
        this.$Progress.finish();
    }
}
</script>
<style scoped>
thead{
    color: #fff;
    background-color: #2a8ee0;
    font-size: 14px;
    padding: 0px;
    border: 1px solid #2a8ee0;
}

.table th, .table td {
    padding: 0.4rem 1.3rem;
}

.details > td {
    padding: 12px;
}

.table td {
    font-size: 12px;
}

.table-fixed{
  width: 100%;
  background-color: #f3f3f3;
}
</style>
