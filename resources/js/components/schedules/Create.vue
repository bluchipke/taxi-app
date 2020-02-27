<template>
    <div class="container">
        <div class="row justify-content-center">          
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    NEW WORKSHEET FORM
                </div>
                <div class="card-body">
                    <form @submit.prevent="createSchedule" @keydown="form.onKeydown($event)">
                        
                  
                    <div class="row">
                        <fieldset class="col-md-3">
                            <legend><h5>General Information</h5></legend>
                            
                            <div class="form-group">
                                <label for="" class="form-label">Select Car:</label>
                                <select type="text" v-model="form.vehicle_id" name="vehicle_id" class="form-control" :class="{ 'is-invalid': form.errors.has('vehicle_id') }">
                                    <option value="">Select</option>
                                    <option v-for="v in vehicles" :key="v.vehicle_id" :value="v.vehicle_id">{{v.number_plate}}</option>
                                </select>
                                        <has-error :form="form" field="vehicle_id"></has-error>
                                        <input type="hidden" name="driver_id" v-model="form.driver_id">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Schedule Date:</label>
                                <datetime format="YYYY-MM-DD" width="190px" v-model="form.sch_date" name="sch_date" :class="{ 'is-invalid': form.errors.has('sch_date') }"></datetime>
                                        <has-error :form="form" field="sch_date"></has-error>
                            </div>
                            <div class="form-group">
                                    <label class="form-label">Opening Mileage</label>
                                        <input v-model="form.opening_mileage" type="text" name="opening_mileage"
                                        class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('opening_mileage') }">
                                        <has-error :form="form" field="opening_mileage"></has-error>
                                </div>
                             <div class="form-group">
                                <label for="" class="form-label">Status:</label>
                                <select type="text" v-model="form.sch_status" name="sch_status" class="form-control" :class="{ 'is-invalid': form.errors.has('sch_status') }">
                                    <option value="">Select</option>
                                    <option value="OPEN">OPEN</option>
                                    <option value="CLOSED">CLOSED</option>
                                    <option value="CANCELLED">CANCELLED</option>
                                </select>
                                        <has-error :form="form" field="sch_status"></has-error>
                            </div>

                        </fieldset>                        
                    </div>
                       <div class="row">
                           <div class="col-md-2 mt-2" style="padding-left: 8px !important;">                               
                                <button :disabled="form.busy" type="submit" class="btn btn-sm btn-block btn-flat btn-success"><i class="fa fa-check"></i> SUBMIT</button>
                           </div>
                       </div>
                    </form>
                </div>
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
        return{    
           
            vehicles: {},
            form: new Form({
                vehicle_id: '',                
                sch_status: '',
                sch_date: '',
                // driver_id: this.$route.params.id,  
                opening_mileage: '',               
            })
        }
    },
    methods: {

        createSchedule(){
            this.form.post('api/schedules')
            .then((data)=>{
                if(data.data.message != null){
                    this.form.reset();
                    Toast.fire({
                        type: 'success',
                        title: data.data.message
                    })
                }else{
                    Toast.fire({
                        type: 'warning',
                        title: data.data.error
                    })
                }
            })
            .catch(()=>{

            })
            // this.form.reset();
        },

        //retrieve the list of vehicles
        getVehicles(){
            axios.get('api/vehicles/open').then(({data})=>{
                this.vehicles = data.data
                
            })
            .catch(()=>{
                
            })
        },

        //retrieve the driver name
        getDriver(){

        },
    },
    created(){
        this.getVehicles();
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

     .card-header{
        /* float:left; */
       background-color: #2a8ee0;
       border-color:#2a8ee0;
       color: #fff;
       font-weight: bold;
       font-size: 14px;
       padding: 5px;
      }

      .card{
          border-radius: 0px;
      }
      .span{
          color: red;
      }
</style>


