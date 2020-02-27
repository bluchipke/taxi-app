<template>
    <div class="container">
        <div class="row justify-content-center">          
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    NEW VEHICLE DETAILS
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateVehicle" @keydown="form.onKeydown($event)">
                    <!-- <alert-success :form="form" message="Your changes have been saved!"></alert-success> -->
                        
                    <div class="row">
                        <fieldset class="col-md-10">
                            <legend><h5>General Information</h5></legend>
                                <div class="row">                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">Plate Number <span class="span">*</span> </label>
                                        <input type="text" v-model="form.number_plate" name="number_plate" class="form-control form-control-sm" required :class="{ 'is-invalid': form.errors.has('number_plate') }">
                                        <has-error :form="form" field="number_plate"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Make<span class="span">*</span> </label>
                                        <input type="text" v-model="form.make" name="make" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('make') }">
                                        <has-error :form="form" field="make"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">Model:<span class="span">*</span> </label>
                                        <input type="text" v-model="form.model" name="model" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('model') }">
                                        <has-error :form="form" field="model"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Color<span class="span">*</span> </label>
                                        <input type="text" v-model="form.color" name="color" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('color') }">
                                        <has-error :form="form" field="color"></has-error>
                                    </div>
                                </div>   
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">Body:<span class="span">*</span> </label>
                                        <input type="text" v-model="form.body" name="body" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('body') }">
                                        <has-error :form="form" field="body"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Current Mileage</label>
                                        <input type="number" v-model="form.mileage" name="mileage" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('mileage') }">
                                        <has-error :form="form" field="mileage"></has-error>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label"># Passengers:<span class="span">*</span> </label>
                                        <input type="text" v-model="form.seating" name="seating" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('seating') }">
                                        <has-error :form="form" field="seating"></has-error>
                                    </div>                                     
                                </div>    
                            </div>                        
                        </fieldset>
                    </div>
                    <div class="row">
                        <fieldset class="col-md-3">
                            <legend><h5>Additional Information</h5></legend>
                            <div class="form-group">
                                <label for="" class="form-label">Gear Type:</label>
                                <input type="text" v-model="form.gear_type" name="gear_type" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('gear_type') }">
                                        <has-error :form="form" field="gear_type"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Chassis No:</label>
                                <input type="text" v-model="form.chassis_number" name="chassis_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('chassis_number') }">
                                        <has-error :form="form" field="chassis_number"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Engine No:</label>
                                <input type="text" v-model="form.engine_number" name="engine_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('engine_number') }">
                                        <has-error :form="form" field="engine_number"></has-error>
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">Fuel Type:</label>
                                <input type="text" v-model="form.fuel_type" name="fuel_type" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('fuel_type') }">
                                        <has-error :form="form" field="fuel_type"></has-error>
                            </div>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <legend><h5>Other Details</h5></legend>
                            <div class="form-group">
                                <label for="" class="form-label">Engine Capacity:</label>
                                <input type="text" v-model="form.capacity" name="capacity" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('capacity') }">
                                        <has-error :form="form" field="capacity"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">YOM:</label>
                                <input type="text" v-model="form.yom" name="yom" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('yom') }">
                                        <has-error :form="form" field="yom"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Condition:</label>
                                <input type="text" v-model="form.condition" name="condition" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('condition') }">
                                        <has-error :form="form" field="condition"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Country of Origin #:</label>
                                <input type="text" v-model="form.origin" name="origin" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('origin') }">
                                        <has-error :form="form" field="origin"></has-error>
                            </div>
                            
                        </fieldset>
                        <fieldset class="col-md-3">
                            <legend><h5>Insurance Information</h5></legend>
                            <div class="form-group">
                                <label for="" class="form-label">Insurer:</label>
                                <input type="text" v-model="form.insurer" name="insurer" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('insurer') }">
                                        <has-error :form="form" field="insurer"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Policy Number:</label>
                                <input type="text" v-model="form.policy_number" name="policy_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('policy_number') }">
                                        <has-error :form="form" field="policy_number"></has-error>
                            </div>                            
                            <div class="form-group">
                                <label for="" class="form-label">Insurance Expiry:</label>
                                <datetime format="YYYY-MM-DD" width="190px" v-model="form.insurance_expiry" name="insurance_expiry" :class="{ 'is-invalid': form.errors.has('insurance_expiry') }"></datetime>
                                        <has-error :form="form" field="insurance_expiry"></has-error>
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">Status:</label>
                                <input type="text" v-model="form.status" name="status" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('status') }">
                                        <has-error :form="form" field="status"></has-error>
                            </div>
                        </fieldset>
                    </div>
                       <div class="row">
                           <div class="col-md-2 mt-2">                               
                                <button :disabled="form.busy" type="submit" class="btn btn-sm btn-block btn-flat btn-success"> <i class="fa fa-check"></i> SAVE</button>
                           </div>
                           <div class="col-md-2 mt-2">                               
                                <button :disabled="form.busy" @click.prevent="deleteVehicle" class="btn btn-sm btn-block btn-flat btn-danger"> <i class="fa fa-trash"></i> DELETE</button>
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
export default {
    components: {
                datetime
            },
    data() {

        return{
            vehicle: {},
            vehicle_id: this.$route.params.id,
            form: new Form({                
                number_plate: '',
                make: '',
                model: '',
                color: '',
                body: '',
                mileage: '',
                gear_type: '',
                chassis_number: '',
                engine_number: '',
                fuel_type: '',
                capacity: '',
                seating:'',
                yom: '',
                origin: '',
                insurer: '',
                policy_number: '',
                condition: '',
                status: '',
                insurance_expiry:''
            })
        }
    },
    methods: {

        getVehicle(){
            axios.get('api/vehicles/'+this.vehicle_id)
            .then(({data})=>(       
                this.form.fill(data)
            ));           
        },
        updateVehicle(){
            this.form.put('api/vehicles/'+this.vehicle_id);
            Toast.fire({
                type: 'success',
                title: 'Vehicle updated successfully.'
            })
        },
        //delete vehicle function
        deleteVehicle(){
            swal.fire({
                title: 'Confirm.',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                //send delete request to the server;                
                    if (result.value) {
                        this.form.delete('api/vehicles/'+this.vehicle_id).then(()=>{
                            swal.fire('Deleted!',
                            'Your record has been deleted.',
                            'success'
                            ) 
                            setTimeout(function(){
                                window.location.href="/vehicles";
                            }, 1000)                            
                        }).catch(()=>{
                            swal.fire('Failed!', 'The operation could not complete', 'warning');
                        })                       
                    }                    
                    
            })                            
        }
        //end delete vehicles
    },
    created() {
        this.getVehicle();
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

    button > .swal2-styled .swal2-confirm{
        border-radius: 0em !important;
    }

    .swal2-styled .swal2-cancel{
        border-radius: 0em !important;
    }
    /* .swal2-styled.swal2-confirm */
</style>


