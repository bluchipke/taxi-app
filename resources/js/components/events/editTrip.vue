<template>
    <div class="container">
        <div class="row justify-content-center">          
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    TRIP DETAILS
                </div>
                <div class="card-body">
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
                                    <input type="text" v-model="form.organization_id" name="organization_id" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('organization_id') }">
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
                                    <label for="" class="form-label">Mileage Out:</label>
                                    <input type="number" v-model="form.mileage_out" name="mileage_out" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('mileage_out') }">
                                            <has-error :form="form" field="mileage_out"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Time Out:</label>
                                    <datetime format="H:i:s" width="100%" v-model="form.time_out" name="time_out" :class="{ 'is-invalid': form.errors.has('time_out') }"></datetime>
                                            <has-error :form="form" field="time_out"></has-error>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="" class="form-label">Mileage In:</label>
                                    <input type="number" v-model="form.mileage_in" name="mileage_in" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('mileage_in') }">
                                            <has-error :form="form" field="mileage_in"></has-error>
                                </div> -->
                                <!-- <div class="form-group">
                                    <label for="" class="form-label">Distance:</label>
                                    <input type="text" v-model="form.distance" name="distance" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('distance') }">
                                            <has-error :form="form" field="distance"></has-error>
                                </div>    
                                                                                    -->
                                <div class="form-group">
                                    <label for="" class="form-label">Schedule:</label>
                                    <input type="text" v-model="form.schedule_id" name="schedule_id" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('schedule_id') }">
                                            <has-error :form="form" field="schedule_id"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Vehicle:</label>
                                    <input type="text" v-model="form.vehicle_id" name="vehicle_id" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('vehicle_id') }">
                                            <has-error :form="form" field="vehicle_id"></has-error>
                                </div> 
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <legend><h5>Time Entry</h5></legend>
                                <div class="form-group">
                                    <label for="" class="form-label">Schedule:</label>
                                    <input type="text" v-model="form.schedule_id" name="schedule_id" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('schedule_id') }">
                                            <has-error :form="form" field="schedule_id"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Vehicle:</label>
                                    <input type="text" v-model="form.vehicle_id" name="vehicle_id" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('vehicle_id') }">
                                            <has-error :form="form" field="vehicle_id"></has-error>
                                </div> 
                                
                                <!-- <div class="form-group">
                                    <label for="" class="form-label">Time In:</label>
                                    <datetime format="H:i:s" width="100%" v-model="form.time_in" value="" name="time_in" :class="{ 'is-invalid': form.errors.has('time_in') }"></datetime>
                                            <has-error :form="form" field="time_in"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Total Time</label>
                                    <input type="text" v-model="form.total_time" name="total_time" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('total_time') }">
                                            <has-error :form="form" field="total_time"></has-error>
                                            
                                </div> -->
                                
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <legend><h5>Payment</h5></legend>
                                <div class="form-group">
                                    <label for="" class="form-label">Payment Mode:</label>
                                    <input type="text" v-model="form.payment" name="payment" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('payment') }">
                                            <has-error :form="form" field="payment"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Charges:</label>
                                    <input type="text" v-model="form.time_in" name="time_in" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('time_in') }">
                                            <has-error :form="form" field="time_in"></has-error>
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
                total_time: ''
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
        }
    }
    
}
</script>

<style scoped>
    fieldset { border:1px solid #c2c2c2; padding: 5px 15px; border-radius: 3px; }
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


