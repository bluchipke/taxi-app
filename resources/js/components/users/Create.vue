<template>
    <div class="container">
        <div class="row justify-content-center" v-show="$gate.isAdmin()">          
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <p>CREATE NEW USER</p>
                </div>
                <div class="card-body">
                    <form @submit.prevent="createUser" @keydown="form.onKeydown($event)">
                        
                    <div class="row">
                        <fieldset class="col-md-10">
                            <legend><h5>Personal Information</h5></legend>
                                <div class="row">
                                    <div class="col-md-3">
                                    <img src="#" alt="User profile" style="width: 200px; height: 200px;">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">First Name</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Last Name</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">ID/Passport:</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">KRA PIN</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                </div>   
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="form-label">Employee Code:</label>
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                     <div class="form-group">
                                        <label for="" class="form-label">Department</label>
                                        <input type="text" class="form-control form-control-sm">
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
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Gender:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Marital Status:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">DOB:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </fieldset>
                        <fieldset class="col-md-4">
                            <legend><h5>Contact Information</h5></legend>
                            <div class="form-group">
                                <label for="" class="form-label">Address:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Post Code:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Mobile #:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">Email:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </fieldset>
                        <fieldset class="col-md-3">
                            <legend><h5>Employment Information</h5></legend>
                            <div class="form-group">
                                <label for="" class="form-label">Job Title:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Employment Status:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Date Started:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                             <div class="form-group">
                                <label for="" class="form-label">Employment Type:</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </fieldset>
                    </div>
                       <div class="row">
                           <fieldset class="col-md-4">
                               <legend><h5>Account Details</h5></legend>
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                        <input v-model="form.name" type="text" name="name"
                                        class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                        <input v-model="form.email" type="text" name="email"
                                        class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('email') }">
                                        <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                        <input v-model="form.password" type="password" name="password"
                                        class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('password') }">
                                        <has-error :form="form" field="password"></has-error>
                                </div>
                                <button :disabled="form.busy" type="submit" class="btn btn-sm btn-primary">Submit</button>
                           </fieldset>
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
                name: '',
                email: '',
                role: '',
                active: ''
            })
        }
    },
    methods: {

        createUser(){
            this.form.post('api/user');
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


