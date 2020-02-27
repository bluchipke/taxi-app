<template>
        <div class="container">
            <div class="row justify-content-center">          
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                       DRIVER COMMISSIONS
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="generateReport" @keydown="form.onKeydown($event)">                        
                        <div class="row">
                            <fieldset class="col-md-12">
                                <!-- <legend><h5>Personal Information</h5></legend> -->
                                    <div class="row">                                    
                                        <!-- <div class="col-md-12"> -->
                                            <div class="form-group col-md-3">
                                                <label for="" class="form-label">Select Driver</label>
                                                <v-select  v-model="form.user_id" type="text" :options="drivers.data" label="name" name="driver" :class="{ 'is-invalid': form.errors.has('driver') }">
                                                </v-select>
                                                <has-error :form="form" field="driver"></has-error>
                                            </div>
                                           <div class="form-group col-md-3">
                                                <label for="" class="form-label">Date 2</label>
                                                <datetime format="YYYY-MM-DD" width="130px" v-model="form.date1" name="date1"  :class="{ 'is-invalid': form.errors.has('date1') }"></datetime>
                                                <has-error :form="form" field="date1"></has-error>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="" class="form-label">Date 2</label>
                                                <datetime format="YYYY-MM-DD" width="130px" v-model="form.date2" name="date2"  :class="{ 'is-invalid': form.errors.has('date2') }"></datetime>
                                                <has-error :form="form" field="date2"></has-error>
                                            </div>
                                            <div class="form-group col-md-3 mt-3">
                                                <button type="submit" class="btn btn-sm btn-flat btn-success">GENERATE REPORT</button>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                    <!-- end row -->
                            </fieldset>
                        </div>
                        </form>
                    </div>                    
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-primary">
                      <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Date:</th>
                                    <th>Client</th>
                                    <th>Organization</th>
                                    <th>Pick:</th>
                                    <th>Drop:</th>
                                    <th>Mileage Out</th>
                                    <th>Mileage In</th>
                                    <th>Time Out</th>
                                    <th>Time In</th>
                                    <th>Distance</th>


                                    <th>Expenses:</th>
                                    <!-- <th>Amount:</th> -->
                                    <!-- <th>Net:</th> -->
                                    <!-- <th>Commission:</th> -->
                                    <!-- <th>Income:</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d in comms.data" :key="d.trip_id">
                                    <td> <router-link to="/to">{{d.trip_date}}</router-link> </td>
                                    <td>{{d.client_name}}</td>
                                    <td>{{d.client_desc}}</td>
                                    <td>{{d.start_point}}</td>
                                    <td>{{d.end_point}}</td>
                                    <td>{{d.mileage_out}}</td>
                                    <td>{{d.mileage_in}}</td>
                                    <td>{{d.time_out}}</td>
                                    <td>{{d.time_in}}</td>
                                    <td>{{d.distance}}</td>


                                    <td class="float">{{expenses = (d.toll_fees + d.trip_misc + d.fuel_expense) | numFormat('0,0.00') }}</td>
                                    <!-- <td class="float">{{d.trip_amount | numFormat('0,0.00')}}</td> -->
                                    <!-- <td class="float">{{amount = d.trip_amount - expenses | numFormat('0,0.00')}}</td> -->
                                    <!-- <td class="float">{{commission = (amount * (d.str_percent/100)) | numFormat('0,0.00')}}</td> -->
                                    <!-- <td class="float">{{d.trip_amount - (expenses+commission) | numFormat('0,0.00')}}</td> -->
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <!-- <div class="card"> -->
                                    <div class="small-box bg-default">
                                        <div class="inner" v-if="comms.data">
                                            <h6 style="font-size: 12px;">Toll Fees: <span style="float:right;"> Ksh: {{tollFees | numFormat('0,0.00')}} </span></h6>
                                            <h6 style="font-size: 12px;">Fuel Amount: <span style="float:right;"> Ksh:  {{fuelAmount | numFormat('0,0.00')}}</span></h6>
                                            <h6 style="font-size: 12px;">Total Misc: <span style="float:right;"> Ksh: {{tripMisc | numFormat('0,0.00')}} </span></h6>
                                            <hr>
                                            <h6 style="font-size: 12px; color: red;">Total Expenses: <span style="float:right;"> Ksh: {{(tripMisc + tollFees + fuelAmount) | numFormat('0,0.00')}} </span></h6>
                                            <!-- <h6 style="font-size: 12px;">Total Amount: <span style="float:right;"> Ksh: {{tripAmount | numFormat('0,0.00')}} </span></h6>  -->
                                            <hr>
                                            <!-- <h6 style="font-size: 12px;">Net Amount: <span style="float:right;"> Ksh: {{tripAmount - (tripMisc + tollFees + fuelAmount) | numFormat('0,0.00')}} </span></h6> -->
                                            <h6 style="font-size: 12px;">Total Mileage: <span style="float:right;"> {{mileage | numFormat('0,0.0')}} KMS </span></h6>
                                            <!-- <h6 style="font-size: 12px; color: green;">Commission: <span style="float:right;"> Ksh: {{failedFunction | numFormat('0,0.00')}} </span></h6> -->
                                            <hr>
                                            <!-- <h6 style="font-size: 12px;">Income: <span style="float:right;"> Ksh: {{ tripAmount - (tripMisc + tollFees + fuelAmount) - failedFunction | numFormat('0,0.00')}} </span></h6>  -->

                                        </div>
                                        <!-- <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div> -->
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components:{
        datetime
    },    
    data(){

        return{
            drivers: [],
            comms: {},
            // comms.data: {},
            commission: 0,
            expenses: 0,
            amount: 0,
            allNet: 0,
            // tollFees: 0,
            // fuelAmount: 0,
            // tripMisc: 0,
            // tripAmount: 0, 
            form: new Form({
                date1: '',
                date2: '',
                user_id: ''

            })
        }
    },
    methods: {
        getDrivers(){
            axios.get('api/drivers').then((data)=>{
                this.drivers = data.data;
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Problem occurred. Data failed to retrieve.'
                })
            })
        },
        generateReport(){
            this.$Progress.start();
            let data;
            this.form.post('api/reports/drivers/commissions').then(({data})=>{
                return this.comms = data;
            }).catch(()=>{
                Toast.fire({
                    type: 'error',
                    title: "Unknow error occurred"                    
                })
                this.$Progress.fail();
            })
            this.$Progress.finish();
        }
    },

    created(){
        this.$Progress.start();
        this.getDrivers();
        this.$Progress.finish();
    },
    computed: {

        tollFees() {

            var toll = this.comms.data.reduce((acc, toll) => acc + toll.toll_fees, 0);
            return parseInt(toll);
        },
        tripMisc() {
                    
            var misc = this.comms.data.reduce((acc, misc) => acc + misc.trip_misc, 0);
            return parseInt(misc);
        },
        tripAmount() {
                    
            var amount = this.comms.data.reduce((acc, amt) => acc + amt.trip_amount, 0);
            return parseInt(amount);
        },
        fuelAmount(){

            var fuel = this.comms.data.reduce((acc, fuel) => acc + fuel.fuel_expense, 0); 
            return parseInt(fuel);       
        },
        mileage(){

            var miles = this.comms.data.reduce((acc, miles) => acc + miles.distance, 0); 
            return parseInt(miles);       
        },
        failedFunction(){            

            var ded = this.comms.data.reduce((acc, ded) => acc + ((ded.trip_amount - (ded.toll_fees + ded.trip_misc + ded.fuel_expense))*(ded.str_percent/100)), 0); 
            // var ded = net
            return parseInt(ded);
        }
    }
}
</script>
<style scoped>
fieldset { border:1px solid #c2c2c2; margin: 5px; border-radius: 3px; }
    .form-control{ border-radius: 0px; }

    legend {
        padding: 0.2em 0.5em;
        /* border:1px solid #c2c2c2; */
        color:#070707;
        font-size:90%;
        text-align:left;
        width: auto;
    }

    .form-control-sm {
        height: calc(1.0em + 0.5rem + 2px);
        padding: 0.75rem 0.5rem;
    }
    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 500;
    }
    label {
        margin-bottom: 0.2rem;
        color: #245d73;
    }
    .form-group {
        margin-bottom: 0.5rem;
    }
    h5, .h5 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 0rem;
        
    }
</style>

