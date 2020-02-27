<template>
    <div class="container">
        <div class="row justify-content-center" v-show="$gate.isAdmin()">          
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    COMMISSION STRUCTURE
                </div>
                <div class="card-body">
                    <form @submit.prevent="createStructure" @keydown="form.onKeydown($event)">
                    <!-- <alert-success :form="form" message="Your changes have been saved!"></alert-success> --> 
                    <div class="row">
                        <fieldset class="col-md-3">
                            <legend><h5>Additional Information</h5></legend>
                            <div class="form-group">
                                <label for="" class="form-label">Label:</label>
                                <input type="text" v-model="form.str_label" name="str_label" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('str_label') }">
                                        <has-error :form="form" field="str_label"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Percentage (%):</label>
                                <input type="number" v-model="form.str_percent" name="str_percent" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('str_percent') }">
                                        <has-error :form="form" field="str_percent"></has-error>
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Amount:</label>
                                <input type="number" v-model="form.str_amount" name="str_amount" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('str_amount') }">
                                        <has-error :form="form" field="str_amount"></has-error>
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">Status:</label>
                                <select type="text" v-model="form.str_status" name="str_status" class="form-control" :class="{ 'is-invalid': form.errors.has('str_status') }">
                                    <option value="">Select</option>
                                    <option value="ACTIVE">ACTIVE</option>
                                </select>
                                        <has-error :form="form" field="str_status"></has-error>
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">Notes:</label>
                                <textarea v-model="form.str_notes" name="str_notes" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('str_notes') }"></textarea>
                                        <has-error :form="form" field="str_notes"></has-error>
                            </div>
                        </fieldset>  
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
        <div v-show="!$gate.isAdmin()">
            <not-found></not-found>
        </div>
    </div>
</template>

<script>
export default {

    data() {

        return{
            form: new Form({
                str_label: '',
                str_percent: '',
                str_amount: '',
                str_status: '',
                str_notes: '',               
            })
        }
    },
    methods: {

        createStructure(){
            this.form.post('api/structures/store')
            .then(()=>{
                this.form.reset();
                Toast.fire({
                    type: 'success',
                    title: 'Commission structure saved successfully.'
                })
            })
            .catch(()=>{

            })           
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


