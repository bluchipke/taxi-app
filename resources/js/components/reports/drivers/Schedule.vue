<template>
        <div class="container">
            <div class="row justify-content-center" v-show="$gate.isAdminOrAccounts()">          
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                       WORKSHEET DETAILED REPORTS
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="generateReport" @keydown="form.onKeydown($event)">                        
                        <div class="row">
                            <fieldset class="col-md-12">
                                <!-- <legend><h5>Personal Information</h5></legend> -->
                                    <div class="row">                                    
                                        <!-- <div class="col-md-12"> -->
                                            <div class="form-group col-md-3">
                                                <label for="" class="form-label">Select Worksheet</label>
                                                <v-select  v-model="form.schedule_id" type="text" :options="schs" label="public_id" name="schedule" :class="{ 'is-invalid': form.errors.has('schedule_id') }">
                                                </v-select>
                                                <has-error :form="form" field="schedule_id"></has-error>
                                            </div>
                                           <!-- <div class="form-group col-md-3">
                                                <label for="" class="form-label">Date 2</label>
                                                <datetime format="YYYY-MM-DD" width="130px" v-model="form.date1" name="date1"  :class="{ 'is-invalid': form.errors.has('date1') }"></datetime>
                                                <has-error :form="form" field="date1"></has-error>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="" class="form-label">Date 2</label>
                                                <datetime format="YYYY-MM-DD" width="130px" v-model="form.date2" name="date2"  :class="{ 'is-invalid': form.errors.has('date2') }"></datetime>
                                                <has-error :form="form" field="date2"></has-error>
                                            </div> -->
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
        </div>
         <div v-show="!$gate.isAdminOrAccounts()">
            <not-found></not-found>
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
            schs: [],
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
                schedule_id: {}

            })
        }
    },
    methods: {
        getSchedules(){
            axios.get('api/schedules/list').then((data)=>{
                this.schs = data.data;
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'Problem occurred. Data failed to retrieve.'
                })
            })
        },
        generateReport(){

            if(this.form.schedule_id == null || this.form.schedule_id['schedule_id'] == null){
                 Toast.fire({
                    type: 'error',
                    title: "No schedule selected."                    
                })

                return;
            }

            this.$Progress.start();            
                window.open('../reports/drivers/worksheet/'+this.form.schedule_id['schedule_id'],'popUpWindow','height='+screen.height+',width='+screen.width+',left=100,top=100,resizable=no,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes');            
            this.$Progress.finish();
        },
        
    },

    created(){
        this.$Progress.start();
        this.getSchedules();
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
                    
            var amount = this.comms.data.reduce((acc, amt) => acc + parseInt(amt.trip_amount), 0);
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

    .main-header{
        display: none;
    }
</style>

