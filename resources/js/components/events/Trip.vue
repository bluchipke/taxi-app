<template>
    <div class="container">
        <div class="row justify-content-center">          
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    TRIP DETAILS
                    <!-- <start-trip user="Hello Molly"></start-trip> -->
                </div>
                <div class="card-body" v-if="trips == 0" key="in-start">
                    <form @submit.prevent="createTrip" @keydown="form.onKeydown($event)">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <fieldset>
                                <legend><h5>Client Information</h5></legend>
                                <div class="form-group">
                                    <label for="" class="form-label">Client Name:</label>
                                    <input type="text" v-model="form.client_name" name="client_name" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('client_name') }">
                                            <has-error :form="form" field="client_name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Organization:</label>
                                    <v-select label="client_desc" v-model="form.organization_id" :options="clients" :value="clients.selected" name="organization_id"  :class="{ 'is-invalid': form.errors.has('organization_id') }">
                                        <!-- <option v-for="client in clients" :value="client.client_id" :key="client.client_id">{{client.client_desc}}</option> -->
                                    </v-select>
                                            <has-error :form="form" field="organization_id"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">From:</label>
                                    <input type="text" v-model="form.start_point" name="start_point" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('start_point') }">
                                            <has-error :form="form" field="start_point"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">To:</label>
                                    <input type="text" v-model="form.end_point" name="end_point" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('end_point') }">
                                            <has-error :form="form" field="end_point"></has-error>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <legend><h5>Trip Details</h5></legend>  
                                 <div class="form-group">
                                    <label for="" class="form-label">Vehicle:</label>
                                    <input type="text" v-model="vehicle" name="vehicle" class="form-control form-control-sm" readonly >
                                            <!-- <has-error :form="form" field="vehicle_id"></has-error> -->
                                </div>                                  
                                <div class="form-group">
                                    <label for="" class="form-label">Mileage Out:</label>
                                    <input type="number" v-model="form.mileage_out" name="mileage_out" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('mileage_out') }">
                                            <has-error :form="form" field="mileage_out"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Time Out:</label>
                                    <datetime format="H:i:s" width="100%" v-model="form.time_out" name="time_out" :class="{ 'is-invalid': form.errors.has('time_out') }"></datetime>
                                            <has-error :form="form" field="time_out"></has-error>
                                </div>                                             
                                
                            </fieldset>
                        </div>                                           
                    </div>
                       <div class="row">
                           <div class="col-md-2 mt-2" style="padding-left: 8px !important;">                               
                                <button :disabled="form.busy" type="submit" class="btn btn-sm btn-block btn-flat btn-success"><i class="fa fa-check"></i> SAVE</button>
                           </div>
                       </div>
                    </form>
                </div>
                <div class="card-body" v-else key="in-progress">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>TRIP IN PROGRESS: </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <router-link to="/trips" class="btn btn-flat btn-lg btn-primary">CONTINUE</router-link>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
import datetime from 'vuejs-datetimepicker';
export default {   
    props: ['user'],
    components: {
                datetime
            },
    data() {
        return{    
            trips: 0,
            clients: [],
            vehicle: '',
            form: new Form({                
                created_date: '',
                client_name: '',
                organization_id: '',
                start_point: '',
                end_point: '',
                mileage_out: '',
                mileage_in: '',
                vehicle_id: '',
                time_out: '',
                time_in: '',
                distance: '',
                schedule_id: '',
                total_time: '',
                completed: ''
            })
        }
    },
    methods: {

        createTrip(){
            this.form.post('api/trips')
            .then(()=>{
                this.form.reset();
                Toast.fire({
                    type: 'success',
                    title: 'Trip details saved successfully.'
                })
            })
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'An error occurred. Records failed to save.'
                })
            })
            // this.form.reset();
        },

        getCurrentTrips(){
            axios.get('api/driver/trips')
            .then(({data})=>(
                this.trips = data
            ))
            .catch(()=>{
                Toast.fire({
                    type: 'warning',
                    title: 'An error occurred. Records failed to retrieve.'
                })
            })            
        },

        getClients(){
             axios.get('api/clients/list').then(({ data})=>(
                 this.clients = data
            ));
        },

        getVehicle(){
             axios.get('api/vehicle/schedule').then(({ data})=>(
                 this.vehicle = data.number_plate,
                 this.form.vehicle_id = data.vehicle_id
            ));
        }
    },

    created(){
        this.$Progress.start();
        this.getCurrentTrips();
        this.getClients();
        this.getVehicle();
        this.$Progress.finish();
    }
    
}
</script>

<style scoped>
    fieldset { border:1px solid #c2c2c2; padding: 5px 15px; border-radius: 3px; }
    .form-control{ border-radius: 0px; }

    legend {
        padding: 0.2em 0.5em;       
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


