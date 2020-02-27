<template>
    <div class="container">
        <div class="row justify-content-center" v-show="$gate.isClientOrAdmin()">          
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    NEW ORGANIZATION
                </div>
                <div class="card-body">
                    <form @submit.prevent="createClient" @keydown="form.onKeydown($event)">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <fieldset>
                                <legend><h5>Client Information</h5></legend>
                                <div class="form-group">
                                    <label for="" class="form-label">Client Name:</label>
                                    <input type="text" v-model="form.client_desc" name="client_desc" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('client_desc') }">
                                            <has-error :form="form" field="client_desc"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Phone:</label>
                                    <input type="text" v-model="form.client_phone" name="client_phone" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('client_phone') }">
                                            <has-error :form="form" field="client_phone"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Email:</label>
                                    <input type="text" v-model="form.client_email" name="client_email" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('client_email') }">
                                            <has-error :form="form" field="client_email"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Address:</label>
                                    <input type="text" v-model="form.client_address" name="client_address" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('client_address') }">
                                            <has-error :form="form" field="client_address"></has-error>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <legend><h5>Secondary Details</h5></legend>                                    
                                <div class="form-group">
                                    <label for="" class="form-label">Account #:</label>
                                    <input type="number" v-model="form.account_number" name="account_number" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('account_number') }">
                                            <has-error :form="form" field="account_number"></has-error>
                                </div>                                
                                <div class="form-group">
                                    <label for="" class="form-label">Company Size:</label>
                                    <input type="number" v-model="form.company_size" name="company_size" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('company_size') }">
                                            <has-error :form="form" field="company_size"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Industry:</label>
                                    <input type="text" v-model="form.industry" name="industry" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('industry') }">
                                            <has-error :form="form" field="industry"></has-error>
                                </div>    
                                                                                   
                                <div class="form-group">
                                    <label for="" class="form-label">Status:</label>
                                    <select v-model="form.client_status" name="client_status" class="form-control" :class="{ 'is-invalid': form.errors.has('client_status') }">
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="INACTIVE">INACTIVE</option>
                                    </select>
                                    <has-error :form="form" field="client_status"></has-error>
                                </div>
                                
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <legend><h5>Other Info</h5></legend>
                                <div class="form-group">
                                    <label for="" class="form-label">County:</label>
                                    <input type="text" v-model="form.county" name="county" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('county') }">
                                            <has-error :form="form" field="county"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">KRA PIN:</label>
                                    <input type="text" v-model="form.client_pin" name="client_pin" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('client_pin') }">
                                            <has-error :form="form" field="client_pin"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Tax Rate:</label>
                                    <input type="number" min="0" v-model="form.tax_rate" name="tax_rate" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('tax_rate') }">
                                            <has-error :form="form" field="tax_rate"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Organization Notes:</label>
                                    <textarea v-model="form.client_notes" name="client_notes" class="form-control" rows="1" :class="{ 'is-invalid': form.errors.has('client_notes') }"></textarea>
                                            <has-error :form="form" field="client_notes"></has-error>
                                </div>
                            </fieldset>
                        </div>  
                         <div class="col-md-4">
                            <fieldset>
                                <legend><h5>Login Details</h5></legend>                                    
                                <div class="form-group">
                                    <label for="" class="form-label">Password:</label>
                                    <input type="password" v-model="form.password" name="password" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('password') }">
                                            <has-error :form="form" field="password"></has-error>
                                </div>                                
                                <div class="form-group">
                                    <label for="" class="form-label">Confirm Password:</label>
                                    <input type="password" v-model="form.confirm_password" name="confirm_password" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('confirm_password') }">
                                            <has-error :form="form" field="confirm_password"></has-error>
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
        <div v-show="!$gate.isAdminOrAccounts()">
            <not-found></not-found>
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
                client_desc: '',
                client_phone: '',
                client_email: '',
                client_address: '',
                account_number: '',
                company_size: '',
                client_notes: '',
                county: '',
                industry: '',
                client_status: '',
            })
        }
    },
    methods: {

        createClient(){
            this.form.post('api/organizations')
            .then(()=>{
                this.form.reset();
                Toast.fire({
                    type: 'success',
                    title: 'Organization details saved successfully.'
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


