<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table border="1" style="width: 100%;">
                            <tr>
                                <td>WORK SHEET REPORTS: {{ uid == 0 ? 'ALL DRIVERS' : sch.first_name+' '+sch.last_name}}</td>
                                <td>BEGINNING: {{this.date1 | moment("MMMM Do YYYY")}}</td>
                                <td>ENDING: {{this.date2 | moment("MMMM Do YYYY")}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table border="1" style="width: 100%;">
                             <tr>
                                    <th>Date</th>
                                    <th>Index:</th>
                                    <th>Trips</th>
                                    <th>Distance:</th>
                                    <th>Toll:</th>
                                    <th>Fuel</th>
                                    <th>Misc</th>
                                    <th style="background-color: red;">Expenses:</th>
                                    <th>Amount:</th>
                                    <th>Net:</th>
                                    <th>Commission:</th>
                                    <th v-show="$gate.isAdmin()">Income:</th>
                                </tr>
                                <tr v-for="d in comms.data" :key="d.schedule_id">
                                    <td>{{d.sch_date}}</td>
                                    <td> <router-link :to="'/reports/drivers/worksheet/'+d.schedule_id">{{d.public_id}}</router-link> </td>
                                    <td>{{d.trips}}</td>
                                    <td>{{d.distance}}</td>
                                    <td class="float">{{d.toll | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.fuel_amount | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.misc | numFormat('0,0.00')}}</td>
                                    <td class="float">{{expenses = (parseInt(d.toll) + parseInt(d.misc) + parseInt(d.fuel_amount)) | numFormat('0,0.00') }}</td>
                                    <td class="float">{{d.trip_amount | numFormat('0,0.00')}}</td>
                                    <td class="float">{{amount = parseInt(d.trip_amount) - expenses | numFormat('0,0.00')}}</td>
                                    <td class="float">{{commission = (amount * (d.str_percent/100)) | numFormat('0,0.00')}}</td>
                                    <td class="float" v-show="$gate.isAdmin()">{{d.trip_amount - (expenses+commission) | numFormat('0,0.00')}}</td>
                                </tr> 
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
                                <td><span style="float:right;"> Ksh: {{fuelAmount | numFormat('0,0.00')}} </span></td>
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
                                <td><span style="float:right; font-weight: bold"> Ksh: {{balance = (tripAmount - (fuelAmount + tollFees + tripMisc)) | numFormat('0,0.00')}} </span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-show="uid != 0">
                <div class="card">
                    <div class="card-body">
                        <h6>DRIVER'S COMMISSION</h6>
                        <table border="1" style="width: 100%; ">
                            <tr>
                                <td><h6 style="font-size: 12px; font-weight: bold;">NET BALANCE:</h6></td>
                                <td><span style="float:right; font-weight: bold;"> Ksh: {{balance | numFormat('0,0.00')}} </span></td>
                            </tr>
                            <tr>
                                <td><h6 style="font-size: 12px;">Commission %: </h6></td>
                                <td><span style="float:right;"> {{balance + ' * '+ sch.str_percent +'%'}}</span></td>
                            </tr>
                            <tr>
                                <td><h6 style="font-size: 12px;"> = </h6></td>
                                <td><span style="float:right;"> Ksh.  {{wage = balance * (sch.str_percent / 100) | numFormat('0,0.00')}}</span></td>
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
            <div class="col-md-3" v-show="uid == 0">
                <div class="card">
                    <div class="card-body">
                        <h6>COMMISSION COMPUTATION</h6>
                        <table border="1" style="width: 100%; ">
                            <tr>
                                <td><h6 style="font-size: 12px; font-weight: bold;">NET BALANCE:</h6></td>
                                <td><span style="float:right; font-weight: bold;"> Ksh: {{balance | numFormat('0,0.00')}} </span></td>
                            </tr>
                            <tr>
                                <td><h6 style="font-size: 12px;">Total Commission: </h6></td>
                                <td><span style="float:right;"> Ksh. {{failedFunction | numFormat('0,0.00')}}</span></td>
                            </tr>
                            <tr>
                                <td><h6 style="font-size: 12px;"> = </h6></td>
                                <td><span style="float:right;"> Ksh.  {{wage = balance * (sch.str_percent / 100) | numFormat('0,0.00')}}</span></td>
                            </tr>                                
                                <tr>
                                <td><h6 style="font-size: 12px;">=</h6></td>
                                <td><span style="float:right;">------------</span></td>
                            </tr>
                            <tr>
                                <td><h6 style="font-size: 12px; font-weight: bold;">NET SALES:</h6></td>
                                <td><span style="float:right; font-weight: bold;"> Ksh: {{(balance - failedFunction) | numFormat('0,0.00')}} </span></td>
                            </tr>
                        </table>
                    </div>
                </div>                    
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6>FUEL CONSUMPTION</h6>
                        <table border="1" style="width: 100%; ">
                            <tr>
                                <td><h6 style="font-size: 12px; font-weight: bold;">OPEN - CLOSED MILEAGES:</h6></td>
                                <td><span style="float:right; font-weight: bold;">  {{totalDistance | numFormat('0,0.0')}} </span></td>
                            </tr>
                            <tr>
                                <td><h6 style="font-size: 12px;">TRIP DISTANCE: </h6></td>
                                <td><span style="float:right;"> {{tripDistance | numFormat('0,0.0')}}</span></td>
                            </tr>
                            <tr>
                                <td><h6 style="font-size: 12px;"> Fuel Amount </h6></td>
                                <td><span style="float:right;"> Ksh.  {{fuelAmount | numFormat('0,0.00')}}</span></td>
                            </tr>                                
                                <tr>
                                <td><h6 style="font-size: 12px;">Consumption Rate</h6></td>
                                <td><span style="float:right;">{{ fuelAmount + ' / '+ totalDistance }} per KM</span></td>
                            </tr>
                            <tr>
                                <td><h6 style="font-size: 12px; font-weight: bold;">=</h6></td>
                                <td><span style="float:right; font-weight: bold;">Ksh.  {{(fuelAmount / totalDistance) | numFormat('0,0.00')}} per KM</span></td>
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
        return {
            comms: {},
            sch: [],
            uid: this.$route.params.id,
            date1: this.$route.params.from,
            date2: this.$route.params.to
        }
    },
    methods:{
        getReports(){

           axios.get('api/reports/drivers/commissions/summary/'+this.uid+'/'+this.date1+'/'+this.date2).then(({data})=>{
                this.comms = data;
            })
        },

        scheduleInformation(){
           axios.get('api/driver/schedule/'+this.uid).then(({data})=>{
                this.sch = data;
            }) 
        }
    },
    created(){
        this.$Progress.start();
        this.scheduleInformation();
        this.getReports();
        this.$Progress.finish();
    },
    computed: {

        tollFees() {

            var toll = this.comms.data.reduce((acc, toll) => acc + parseInt(toll.toll), 0);
            return parseInt(toll);
        },
        tripMisc() {
                    
            var misc = this.comms.data.reduce((acc, misc) => acc + parseInt(misc.misc), 0);
            return parseInt(misc);
        },
        tripAmount() {
                    
            var trip_amount = this.comms.data.reduce((acc, trip_amount) => acc + parseInt(trip_amount.trip_amount), 0);
            return parseInt(trip_amount);
        },
        fuelAmount(){

            var fuel = this.comms.data.reduce((acc, fuel) => acc + parseInt(fuel.fuel_amount), 0); 
            return parseInt(fuel);       
        },
        totalDistance(){

            var dist = this.comms.data.reduce((acc, dist) => acc + (parseInt(dist.closing_mileage) - parseInt(dist.opening_mileage)), 0); 
            return parseInt(dist);       
        },
        tripDistance(){

            var distance = this.comms.data.reduce((acc, distance) => acc + parseInt(distance.distance), 0); 
            return parseInt(distance);       
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
    
</style>


