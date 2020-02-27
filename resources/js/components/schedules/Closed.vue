<template>
    <div class="contai">
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">                             
                            <div class="col-md-5">
                                <h5>DRIVER WORK SHEETS</h5>
                            </div>
                            <div class="col-md-3">
                                <!-- SEARCH FORM -->
                                <div class="form-inline ml-3">
                                <div class="input-group input-group-sm">
                                    <input class="form-control col-md-6 form-control-navbar" type="search" v-model="vsearch" @keyup="searchV" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <router-link :to="'/drivers/schedule/create'" class="btn btn-xs btn-flat btn-primary btn-block">NEW WORK SHEET</router-link>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-xs btn-flat btn-success btn-block">EXCEL</button>
                            </div>                           
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Date:</th>
                                    <th>Serial</th>
                                    <th v-show="!$gate.isDriver()">Driver</th>
                                    <th>Distance</th>
                                    <th>Trips</th>
                                    <th v-show="!$gate.isDriver()">Amount</th>
                                    <th>Status</th>
                                    <th>Closed By</th>
                                    <!-- <th>Toll:</th>
                                    <th>Fuel:</th>
                                    <th>Misc:</th>
                                    <th style="background-color: red;">Expenses:</th>
                                    <th>Amount</th>
                                    <th>Net</th>
                                    <th>Commission</th>
                                    <th style="background-color: green;">Income</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in schedules.data" :key="d.schedule_id">
                                    <td>{{++index}}</td>
                                    <td> <router-link :to="'/schedules/'+d.schedule_id+'/show'">{{d.sch_date}}</router-link> </td>
                                    <td><a href="#" @click.prevent="showItem(d)">{{d.public_id}}</a></td>
                                    <td v-show="!$gate.isDriver()">{{d.first_name+' '+d.last_name}}</td>
                                    <td style="text-float: right;">{{d.distance | numFormat('0,0.00')}} KMS</td>
                                    <td style="text-float: right;">{{d.trips | numFormat('0,0.0')}}</td>
                                    <td v-show="!$gate.isDriver()" style="text-float: right;">Ksh. {{d.amount | numFormat('0,0.00')}}</td>
                                    <td>{{d.sch_status}}</td>
                                    <td>{{d.name}}</td>
                                    <!-- <td class="float">{{d.toll  | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.fuel | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.misc | numFormat('0,0.00')}}</td>
                                    <td class="float">{{expenses = (parseInt(d.misc) + parseInt(d.toll) + parseInt(d.fuel)) | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.amount | numFormat('0,0.00')}}</td>
                                    <td class="float">{{net = d.amount - expenses | numFormat('0,0.00')}}</td>
                                    <td class="float">{{comm = net * (d.str_percent/100) | numFormat('0,0.00')}}</td>
                                    <td class="float">{{net - comm | numFormat('0,0.00')}}</td> -->
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="schedules" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Sheet: <span class="btn btn-md btn-flat btn-success"> {{this.form.sch_status}}</span></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        </div>
                            <form @submit.prevent="updateSchedule" @keydown="form.onKeydown($event)"> 
                                <div class="modal-body">
                                            <!-- <div class="row"> -->
                                                <!-- <fieldset class="col-md-12"> -->
                                                    <div class="form-group row">
                                                            <label class="form-label col-md-4">Schedule:</label>
                                                                <input v-model="form.public_id" type="text" name="public_id" readonly
                                                                class="form-control col-md-6 form-control-sm" :class="{ 'is-invalid': form.errors.has('public_id') }">
                                                                <has-error :form="form" field="public_id"></has-error>
                                                    </div>
                                                    <div v-show="$gate.isAdmin()">
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-4">Select Car:</label>
                                                            <select type="text"  v-model="form.vehicle_id" name="vehicle_id" class="form-control col-md-6 " :class="{ 'is-invalid': form.errors.has('vehicle_id') }">
                                                                <option value="">Select</option>
                                                                <option v-for="v in vehicles" :key="v.vehicle_id" :value="v.vehicle_id">{{v.number_plate}}</option>
                                                            </select>
                                                                    <has-error :form="form" field="vehicle_id"></has-error>
                                                                    <input type="hidden" name="driver_id" v-model="form.driver_id">
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="" class="form-label col-md-4">Schedule Date:</label>
                                                            <datetime format="YYYY-MM-DD"  width="210px" v-model="form.sch_date" name="sch_date" :class="{ 'is-invalid': form.errors.has('sch_date') }"></datetime>
                                                                    <has-error :form="form" field="sch_date"></has-error>
                                                        </div>
                                                        <div class="form-group row">
                                                                <label class="form-label col-md-4">Opening Mileage</label>
                                                                    <input v-model="form.opening_mileage" type="text" name="opening_mileage" 
                                                                    class="form-control col-md-6 form-control-sm" :class="{ 'is-invalid': form.errors.has('opening_mileage') }">
                                                                    <has-error :form="form" field="opening_mileage"></has-error>
                                                        </div>
                                                    </div>
                                                     <div class="form-group row">
                                                            <label class="form-label col-md-4">Closing Mileage</label>
                                                                <input v-model="form.closing_mileage" type="text" name="closing_mileage"
                                                                class="form-control col-md-6 form-control-sm" :class="{ 'is-invalid': form.errors.has('closing_mileage') }">
                                                                <has-error :form="form" field="closing_mileage"></has-error>
                                                    </div>
                                                     <div class="form-group row">
                                                            <label class="form-label col-md-4">Fuel Expenses</label>
                                                                <input v-model="form.fuel_amount" type="text" name="fuel_amount"
                                                                class="form-control col-md-6 form-control-sm" :class="{ 'is-invalid': form.errors.has('fuel_amount') }">
                                                                <has-error :form="form" field="fuel_amount"></has-error>
                                                    </div>                                                   
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">EXIT</button>
                                    <button :disabled="form.busy" type="submit" v-show="this.form.opened == 0 || $gate.isAdminOrAccounts() && this.form.sc_closed == 0" class="btn btn-sm btn-flat btn-primary">UPDATE</button>
                                    <button :disabled="form.busy" type="submit" v-show="$gate.isDriver() && this.form.opened == 0" @click.prevent="closeSchedule" class="btn btn-sm btn-flat btn-danger">CLOSE</button>
                                    <button :disabled="form.busy" type="submit" v-show="$gate.isAdminOrAccounts() && this.form.sc_closed == 0" @click.prevent="closeSchedule" class="btn btn-sm btn-flat btn-danger">CLOSE</button>
                                    <button :disabled="form.busy" type="submit" v-show="$gate.isAdmin() && this.form.sc_closed == 1" @click.prevent="openSchedule" class="btn btn-sm btn-flat btn-primary">OPEN</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
        </div>    
    </div>    
</template>
<script>
import datetime from 'vuejs-datetimepicker';
export default {
    components: {
        datetime
    },
    data() {
        return {
            schedules: {},
            driver_id: this.$route.params.id,
            vsearch: '',
            expenses: 0,
            vehicles: {},
            net: 0,
            comm: 0,
            form: new Form({
                schedule_id: '',
                sch_status: '',
                vehicle_id: '',
                sch_date: '',
                public_id: '',
                opening_mileage: '',
                closing_mileage: '',
                fuel_amount: '',
                comments: '',
                opened: '',
                sc_closed: '',
            })
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/schedules?page=' + page)
				.then(response => {
					this.schedules = response.data;
				});
		},
        getSchedules(){
            axios.get('api/schedules/closed').then(({ data})=>(this.schedules = data));
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.schedules = data
            ))
            .catch(()=>{

            })
            
        },
        showItem(d){
            $('#modal-default').modal('show');            
            this.form.reset();
            this.getVehicles();
            this.form.fill(d);
        },
        //retrieve the list of vehicles
        getVehicles(){
            axios.get('api/vehicles').then(({data})=>{
                this.vehicles = data.data
                
            })
            .catch(()=>{
                
            })
        },
        // update schedule
        updateSchedule(){

            this.form.put('api/schedules/'+this.form.schedule_id).then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Schedule update successful.'
                })
                this.form.reset();                
                $('#modal-default').modal('hide');
                this.getSchedules();
                
            })
            .catch(()=>{
                Toast.fire({
                    type: 'error',
                    title: 'Schedule update failed. Please try again later.'
                })
            });
        },
         // update schedule
        closeSchedule(){

            this.form.put('api/schedules/close/'+this.form.schedule_id).then((data)=>{
                Toast.fire({
                    type: 'success',
                    title: data.data.message
                })
                this.form.reset();                
                $('#modal-default').modal('hide');
                this.getSchedules();
                
            })
            .catch(()=>{
                Toast.fire({
                    type: 'error',
                    title: 'Worksheet update failed. Please try again later.'
                })
            });
        }
    },
    created(){
        this.$Progress.start();
        this.getSchedules();
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

.table td {
    font-size: 12px;
}

.table-fixed{
  width: 100%;
  background-color: #f3f3f3;
}

.float{
    text-align: right;
}
</style>
