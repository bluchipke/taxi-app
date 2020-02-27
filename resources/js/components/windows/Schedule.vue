<template>
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 style="text-align: center;">DRIVER WORKSHEET</h5>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">                    
                    <div class="card-body">
                         <table border="1" style="width: 100%;">
                             <tr>
                                 <td>SERIAL #</td>
                                 <td>{{schs.public_id}}</td>
                             </tr>
                             <tr>
                                 <td>DATE:</td>
                                 <td>{{schs.sch_date | moment("MMMM Do YYYY")}}</td>
                             </tr>
                             <tr>
                                 <td>DAY</td>
                                 <td>{{ schs.sch_date | moment("dddd") }}</td>
                             </tr>
                         </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">                   
                    <div class="card-body">
                         <table border="1" style="width: 100%;">
                             <tr>
                                 <td>VEHICLE:</td>
                                 <td>{{schs.postal_code}}</td>
                                 <td>DRIVER:</td>
                                 <td>{{schs.first_name+' '+schs.last_name}}</td>
                             </tr>
                             <tr>
                                 <td>OPENING MILEAGE</td>
                                 <td>{{schs.opening_mileage}}</td>
                                 <td>CLOSING MILEAGE</td>
                                 <td>{{schs.closing_mileage}}</td>
                             </tr>
                             <tr>
                                 <td colspan="2">DISTANCE:</td>
                                 <td>{{schs.closing_mileage - schs.opening_mileage}}</td>
                             </tr>
                         </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                      <div class="card-body">
                        <table border="1" style="width: 100%; padding: 2px;">
                            <!-- <thead> -->
                                <tr>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Organization</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Mileage Out</th>
                                    <th>Mileage In</th>
                                    <!-- <th>Index:</th> -->
                                    <!-- <th>Trips</th> -->
                                    <th>Distance:</th>
                                    <th>Time Out</th>
                                    <th>Time In</th>                                    
                                    <th>Toll:</th>
                                    <!-- <th>Fuel</th> -->
                                    <th>Misc</th>
                                    <th>Txn Code</th>
                                    <!-- <th style="background-color: red;">Expenses:</th> -->
                                    <th>Amount:</th>
                                    <!-- <th>Net:</th> -->
                                    <!-- <th>Commission:</th> -->
                                    <!-- <th v-show="$gate.isAdmin()">Income:</th> -->
                                </tr>
                            <!-- </thead> -->
                            <!-- <tbody> -->
                                <tr v-for="d in comms.data" :key="d.trip_id">
                                    <td>{{d.sch_date}}</td>
                                    <td>{{d.client_name}}</td>
                                    <td>{{d.client_desc}}</td>
                                    <td>{{d.start_point}}</td>
                                    <td>{{d.end_point}}</td>
                                    <td>{{d.mileage_out}}</td>
                                    <td>{{d.mileage_in}}</td>
                                    <!-- <td> <router-link to="/">{{d.public_id}}</router-link> </td> -->
                                    <!-- <td>{{d.trips}}</td> -->
                                    <td>{{d.distance}}</td>
                                    <td>{{d.time_out}}</td>
                                    <td>{{d.time_in}}</td>
                                    <td class="float">{{d.toll_fees | numFormat('0,0.00')}}</td>
                                    <!-- <td class="float">{{d.fuel_amount | numFormat('0,0.00')}}</td> -->
                                    <td class="float">{{d.trip_misc | numFormat('0,0.00')}}</td>
                                    <td>{{d.payment_code}}</td>
                                    <!-- <td class="float">{{expenses = (parseInt(d.toll) + parseInt(d.misc) + parseInt(d.fuel_amount)) | numFormat('0,0.00') }}</td> -->
                                    <td class="float">{{d.trip_amount | numFormat('0,0.00')}}</td>
                                    <!-- <td class="float">{{amount = parseInt(d.trip_amount) - expenses | numFormat('0,0.00')}}</td> -->
                                    <!-- <td class="float">{{commission = (amount * (d.str_percent/100)) | numFormat('0,0.00')}}</td> -->
                                    <!-- <td class="float" v-show="$gate.isAdmin()">{{d.trip_amount - (expenses+commission) | numFormat('0,0.00')}}</td> -->
                                </tr>                                
                            <!-- </tbody> -->
                        </table>
                    </div>                   
                </div>
            </div>
        </div>
         <div class="row">
                <div class="col-md-3">
                    <div class="card">                        
                        <div class="card-body">
                            <h6>WORKINGS COMPUTATION</h6>
                            <table border="1" style="width: 100%; ">
                                <tr>
                                    <td><h6 style="font-size: 12px;">Total Collections:</h6></td>
                                    <td><span style="float:right;"> Ksh: {{tripAmount | numFormat('0,0.00')}} </span></td>
                                </tr>
                                <tr>
                                    <td><h6 style="font-size: 12px;">Fuel:</h6></td>
                                    <td><span style="float:right;"> Ksh: {{schs.fuel_amount | numFormat('0,0.00')}} </span></td>
                                </tr>
                                <tr>
                                    <td><h6 style="font-size: 12px;">Toll:</h6></td>
                                    <td><span style="float:right;"> Ksh: {{tollFees | numFormat('0,0.00')}} </span></td>
                                </tr>
                                 <tr>
                                    <td><h6 style="font-size: 12px;">Misc:</h6></td>
                                    <td><span style="float:right;"> Ksh: {{tripMisc | numFormat('0,0.00')}} </span></td>
                                </tr>
                                <tr>
                                    <td><h6 style="font-size: 12px; font-weight: bold;">NET BALANCE:</h6></td>
                                    <td><span style="float:right; font-weight: bold"> Ksh: {{balance = (tripAmount - (schs.fuel_amount + tollFees + tripMisc)) | numFormat('0,0.00')}} </span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>DRIVERS COMMISSION</h6>
                            <table border="1" style="width: 100%; ">
                                <tr>
                                    <td><h6 style="font-size: 12px; font-weight: bold;">NET BALANCE:</h6></td>
                                    <td><span style="float:right; font-weight: bold;"> Ksh: {{balance | numFormat('0,0.00')}} </span></td>
                                </tr>
                                <tr>
                                    <td><h6 style="font-size: 12px;">Commission %: </h6></td>
                                    <td><span style="float:right;"> {{balance + ' * '+ schs.str_percent +'%'}}</span></td>
                                </tr>
                                <tr>
                                    <td><h6 style="font-size: 12px;"> = </h6></td>
                                    <td><span style="float:right;"> Ksh.  {{wage = balance * (schs.str_percent / 100) | numFormat('0,0.00')}}</span></td>
                                </tr>                                
                                 <tr>
                                    <td><h6 style="font-size: 12px;"></h6></td>
                                    <td><span style="float:right;">------------</span></td>
                                </tr>
                                <tr>
                                    <td><h6 style="font-size: 12px; font-weight: bold;">NET SALES:</h6></td>
                                    <td><span style="float:right; font-weight: bold;"> Ksh: {{(balance - wage) | numFormat('0,0.00')}} </span></td>
                                </tr>
                            </table>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="card" v-if="comms.data">
                        <div class="card-body">
                            <h6>FUEL CONSUMPTION</h6>
                            <table border="1" style="width: 100%; ">
                                
                                <tr>
                                    <td><h6 style="font-size: 12px;">Opening Mileage: </h6></td>
                                    <td><span style="float:right;"> {{schs.opening_mileage | numFormat('0,0.0')}} </span></td>
                                </tr>
                                <tr>
                                    <td><h6 style="font-size: 12px; color: red;">Closing Mileage: </h6></td>
                                    <td><span style="float:right;"> {{(schs.closing_mileage) | numFormat('0,0.0')}} </span></td>
                                </tr>
                                <tr>
                                    <td> <h6 style="font-size: 12px;">Total Covered: </h6> </td>
                                    <td><span style="float:right;"> {{covered = (schs.closing_mileage - schs.opening_mileage) | numFormat('0,0')}} Kms</span></td>
                                </tr>
                                <tr>
                                    <td><h6 style="font-size: 12px;">Fuel Amount: </h6></td>
                                    <td><span style="float:right;"> Ksh: {{schs.fuel_amount | numFormat('0,0.00')}} </span></td>
                                </tr>
                                <tr>
                                    <td><h6 style="font-size: 12px; color: green;">Consumption Rate: </h6></td>
                                    <td><span style="float:right;"> Ksh: {{schs.fuel_amount / covered | numFormat('0,0.00')}} per KM</span></td>
                                </tr>
                               
                            </table>    
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            // data : window.data,
            comms: '',
            schs: [],
            balance : 0,
            wage: 0,
            covered: 0,
        }
    },
    methods: {
        getData(){
            this.$Progress.start();
            // let data;
            axios.get('api/reports/drivers/worksheet/'+this.$route.params.id).then(({data})=>{
                return this.comms = data;
            }).catch(()=>{
                Toast.fire({
                    type: 'error',
                    title: "Unknown error occurred."                    
                })
                this.$Progress.fail();
            })
            this.$Progress.finish();
        },
        scheduleInformation(){
           axios.get('api/schedules/singlelist/'+this.$route.params.id).then(({data})=>{
                this.schs = data;
            }) 
        }
        
    },
    created(){
        this.$Progress.start();
            this.getData();
            this.scheduleInformation();
        this.$Progress.finish();
    },
    computed: {

        tollFees() {

            var toll = this.comms.data.reduce((acc, toll) => acc + parseInt(toll.toll_fees), 0);
            return parseInt(toll);
        },
        tripMisc() {
                    
            var misc = this.comms.data.reduce((acc, misc) => acc + parseInt(misc.trip_misc), 0);
            return parseInt(misc);
        },
        tripAmount() {
                    
            var amount = this.comms.data.reduce((acc, amount) => acc + parseInt(amount.trip_amount), 0);
            return parseInt(amount);
        },
        fuelAmount(){

            var fuel = this.comms.data.reduce((acc, fuel) => acc + parseInt(fuel.fuel_amount), 0); 
            return parseInt(fuel);       
        },
        deduction(){

            var ded = this.comms.data.reduce((acc, ded) => acc + parseInt(ded.commission), 0); 
            return parseInt(ded);       
        },
        failedFunction(){            

            var ded = this.comms.data.reduce((acc, ded) => acc + ((parseInt(ded.trip_amount) - (parseInt(ded.toll) + parseInt(ded.misc) + parseInt(ded.fuel_amount)))*(ded.str_percent/100)), 0); 
            // var ded = net
            return parseInt(ded);
        }
    }
}
</script>
<style scoped>

    /* .main-header, .navbar, .navbar-expand, .bg-white, .navbar-light, .border-bottom{
            display: none;
    }
    .main-sidebar, .sidebar-dark-primary, .elevation-4{
            display: none;
    } */
    tr > td {
        padding: 2px;
    }

    .wrapper >>> .main-header{
        display: none;
    }

    body >>> aside{
        display: none;
    }
</style>



