<template>
    <div class="contai">
        <div class="row justify-content-center">          
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <p>UPDATE DRIVER</p>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateDriver" @keydown="form.onKeydown($event)">
                        
                    <div class="row">
                        <fieldset class="col-md-10">
                            <legend><h5>Personal Information</h5></legend>
                                <div class="row">                                    
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">First Name</label>
                                        <input v-model="form.first_name" type="text" name="first_name" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                        <has-error :form="form" field="first_name"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Last Name</label>
                                        <input v-model="form.last_name" type="text" name="last_name" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('last_name') }">
                                        <has-error :form="form" field="last_name"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">ID/Passport:</label>
                                        <input v-model="form.id_card" type="text" name="id_card" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('id_card') }">
                                        <has-error :form="form" field="id_card"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">KRA PIN</label>
                                        <input v-model="form.kra_pin" type="text" name="kra_pin" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('kra_pin') }">
                                        <has-error :form="form" field="kra_pin"></has-error>
                                    </div>
                                </div>   
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">Employee Code:</label>
                                        <input v-model="form.employee_code" type="text" name="employee_code" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('employee_code') }">
                                        <has-error :form="form" field="employee_code"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Department</label>
                                        <select v-model="form.department" type="text" name="department" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('department') }">

                                        </select>
                                        <has-error :form="form" field="department"></has-error>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">NSSF Number:</label>
                                        <input v-model="form.nssf" type="text" name="nssf" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('nssf') }">
                                        <has-error :form="form" field="nssf"></has-error>
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">NHIF Number:</label>
                                        <input v-model="form.nhif" type="text" name="nhif" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('nhif') }">
                                        <has-error :form="form" field="nhif"></has-error>
                                    </div>
                                </div>    
                            </div>                        
                        </fieldset>
                    </div>
                    <div class="row">
                        <fieldset class="col-md-3">
                            <legend><h5>Additional Information</h5></legend>
                            <div class="form-group">
                                <label for="" class="form-label">Title:</label>
                                <select v-model="form.title" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                                    <option value="">Select Title</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs.</option>
                                    <option value="Miss">Miss.</option>
                                </select>
                                        <has-error :form="form" field="title"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Gender:</label>
                                <select v-model="form.gender" type="text" name="gender" class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }">
                                    <option value="">Select</option>
                                    <option value="MALE">MALE</option>
                                    <option value="FEMALE">FEMALE</option>
                                </select>
                                        <has-error :form="form" field="gender"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Marital Status:</label>
                                <select v-model="form.marital_status" type="text" name="marital_status" class="form-control" :class="{ 'is-invalid': form.errors.has('marital_status') }">
                                    <option value="">Select</option>
                                    <option value="SINGLE">SINGLE</option>
                                    <option value="MARRIED">MARRIED</option>
                                    <option value="WIDOWED">WIDOWED</option>
                                    <option value="DIVORCED">DIVORCED</option>
                                </select>
                                        <has-error :form="form" field="marital_status"></has-error>
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">DOB:</label>
                                <datetime format='YYYY-MM-DD' v-model="form.date_of_birth" type="text" name="date_of_birth" style="width: 200px !important;" :class="{ 'is-invalid': form.errors.has('date_of_birth') }"></datetime>
                                        <has-error :form="form" field="date_of_birth"></has-error>
                            </div>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <legend><h5>Contact Information</h5></legend>
                            <div class="form-group">
                                <label for="" class="form-label">Address:</label>
                                <input v-model="form.box_address" type="text" name="box_address" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('box_address') }">
                                        <has-error :form="form" field="box_address"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Post Code:</label>
                                <input v-model="form.postal_code" type="text" name="postal_code" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('postal_code') }">
                                        <has-error :form="form" field="postal_code"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Mobile #:</label>
                                <input v-model="form.phone_number" type="text" name="phone_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('phone_number') }">
                                        <has-error :form="form" field="phone_number"></has-error>
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">Email:</label>
                                <input v-model="form.driver_email" type="text" name="driver_email" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('driver_email') }">
                                        <has-error :form="form" field="driver_email"></has-error>
                            </div>
                        </fieldset>
                        <fieldset class="col-md-3">
                            <legend><h5>Employment Information</h5></legend>
                            <div class="form-group">
                                <label for="" class="form-label">Job Title:</label>
                                <input v-model="form.job_title" type="text" name="job_title" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('job_title') }">
                                        <has-error :form="form" field="job_title"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Employment Status:</label>
                                <select v-model="form.employment_status" type="text" name="employment_status" class="form-control" :class="{ 'is-invalid': form.errors.has('employment_status') }">
                                    <option value="">Select</option>
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="SUSPENDED">SUSPENDED</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                                <has-error :form="form" field="employment_status"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Date Started:</label>
                                <datetime format="YYYY-MM-DD" v-model="form.date_started" type="text" name="date_started"  :class="{ 'is-invalid': form.errors.has('date_started') }"></datetime>
                                        <has-error :form="form" field="date_started"></has-error>
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">Employment Type:</label>
                                <select v-model="form.employment_type" type="text" name="employment_type" class="form-control" :class="{ 'is-invalid': form.errors.has('employment_type') }">
                                    <option value="">Select</option>
                                    <option value="CONTRACT">CONTRACT</option>
                                    <option value="PERMANENT">PERMANENT</option>
                                    <option value="FREELANCE">FREELANCE</option>
                                </select>
                                        <has-error :form="form" field="employment_type"></has-error>
                            </div>
                        </fieldset>
                    </div>
                       <div class="row">
                           <fieldset class="col-md-3">
                               <legend><h5>Next of Kin </h5></legend>
                                <div class="form-group">
                                    <label class="form-label">Name:</label>
                                        <input v-model="form.next_of_kin" type="text" name="next_of_kin"
                                        class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('next_of_kin') }">
                                        <has-error :form="form" field="next_of_kin"></has-error>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Relationship</label>
                                        <select v-model="form.relationship" name="relationship"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('relationship') }">
                                            <option value="">Select</option>
                                            <option value="HUSBAND">HUSBAND</option>
                                            <option value="WIFE">WIFE</option>
                                            <option value="SON">SON</option>
                                            <option value="DAUGHTER">DAUGHTER</option>
                                            <option value="GUARDIAN">GUARDIAN</option>
                                            <option value="FAMILY MEMBER">FAMILY MEMBER</option>                                            
                                        </select>
                                        <has-error :form="form" field="relationship"></has-error>
                                        
                                </div>  
                                <div class="form-group">
                                    <label class="form-label">Email:</label>
                                        <input v-model="form.next_of_kin_email" type="text" name="next_of_kin_email"
                                        class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('next_of_kin_email') }">
                                        <has-error :form="form" field="next_of_kin_email"></has-error>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone:</label>
                                        <input v-model="form.next_of_kin_phone" type="text" name="next_of_kin_phone"
                                        class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('next_of_kin_phone') }">
                                        <has-error :form="form" field="next_of_kin_phone"></has-error>
                                </div>  
                                                             
                           </fieldset>   
                           <fieldset class="col-md-4">
                               <legend><h5>Account Details</h5></legend>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                        <input v-model="form.password" type="password" name="password"
                                        class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('password') }">
                                        <has-error :form="form" field="password"></has-error>
                                </div>  
                                <div class="form-group">
                                    <label class="form-label">Confirm Password</label>
                                        <input v-model="form.confirm_password" type="password" name="confirm_password"
                                        class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('confirm_password') }">
                                        <has-error :form="form" field="confirm_password"></has-error>
                                </div>                               
                           </fieldset> 
                           <fieldset class="col-md-3">
                               <legend><h5>Compensation</h5></legend>
                                <div class="form-group">
                                    <label class="form-label">Commission Structure</label>
                                        <select v-model="form.commission" type="text" name="commission"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('commission') }">
                                            <option value="">Select</option>
                                           <option v-for="str in structures.data" :key="str.structure_id" :value="str.structure_id">{{str.str_label}} - {{str.str_percent}}%</option>
                                        </select>
                                        <has-error :form="form" field="commission"></has-error>
                                </div>                                                          
                           </fieldset>                         
                       </div>
                       <div class="row">
                            <div class="col-md-2" style="padding-left: 8px !important;">
                                <button :disabled="form.busy" type="submit" class="btn btn-md btn-block btn-flat btn-success"> <i class="fa fa-check"></i> SAVE </button>
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
            structures:'',
            driver: {},
            driver_id: this.$route.params.id,
            form: new Form({
                title:'',
                first_name: '',
                last_name: '',
                driver_email: '',
                id_card: '',
                kra_pin: '',
                nssf: '',
                nhif: '',
                employee_code: '',
                department: '',
                phone_number: '',
                gender: '',
                marital_status: '',
                date_of_birth: '',
                county: '',
                estate: '',
                box_address: '',
                postal_code: '',
                town: '',
                job_title: '',
                date_started: '',
                employment_type: '',
                employment_status: '',
                next_of_kin: '',
                next_of_kin_email: '',
                next_of_kin_phone: '',
                relationship: '',
                commission: '',
                name: '',
                email: ''
            })
        }
    },
    methods: {
        getDriver(){
            axios.get('api/drivers/'+this.driver_id).then(({data})=>(
                this.form.fill(data)
            ));
        },
        updateDriver(){
            this.form.put('api/drivers/'+this.driver_id).then(()=>{
                Toast.fire({
                    type: 'success',
                    title: 'Driver update successful.'
                })
                // this.form.reset();
            })
            .catch(()=>{
                Toast.fire({
                    type: 'error',
                    title: 'Driver update failed. Please try again later.'
                })
            });
        },
        getstructures(){
            axios.get('api/structures').then(({ data})=>(this.structures = data));
        },
    },
    created(){
        this.$Progress.start();
        this.getDriver();
        this.getstructures();
        this.$Progress.finish();
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


