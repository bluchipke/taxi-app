<template>
        <div class="container">
            <div class="row justify-content-center">          
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p>REPORTS</p>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="generateReport" @keydown="form.onKeydown($event)">                        
                        <div class="row">
                            <fieldset class="col-md-3">
                                <legend><h5>Personal Information</h5></legend>
                                    <div class="row">                                    
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="" class="form-label">Date 1</label>
                                                <input v-model="form.date1" type="text" name="first_name" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                                <has-error :form="form" field="first_name"></has-error>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label">Date 2</label>
                                                <input v-model="form.date2" type="text" name="last_name" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('last_name') }">
                                                <has-error :form="form" field="last_name"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                            </fieldset>
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
    
    data(){

        return{
            form: new Form({
                date1: '',
                date2: ''

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
</style>

