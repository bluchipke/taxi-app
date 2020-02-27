<template>
    <div class="container">
        <div class="row" v-show="$gate.isAdmin()">          
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-7">
                      <p>SYSTEM USERS MANAGEMENT</p>    
                    </div>                    
                    <div class="col-md-3">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-2">   
                        <button class="btn btn-sm btn-flat btn-success btn-block" @click.prevent="createForm">NEW</button>                        
                    </div>                    
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-fixed">
                  <thead>
                  <tr>
                    <!-- <th>ID</th> -->
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr> 
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <!-- <td>{{user.id}}</td> -->
                        <td> <a href="#" @click.prevent="updateForm(user)">{{user.name}}</a> </td>
                        <td>{{user.email}}</td>
                        <td><span class="tag tag-warning" style="text-transform: uppercase;">{{user.role}}</span></td>
                        <td>{{user.user_status}}</td>
                        <td>
                          <div class="row">
                            <div class="col-md-4">
                              <a href="#" @click.prevent="deleteUser(user.id)"><i class="fa fa-trash"></i></a>
                            </div>
                          </div>
                        </td>
                      </tr>                      
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- modal -->
                <div class="modal fade" id="modal-default" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode">EDIT USER</h5>
                        <h5 class="modal-title" v-show="!editmode">CREATE USER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                      </div>
                      <form @submit.prevent="editmode ? updateUser() : createUser()" @keydown="form.onKeydown($event)">
                      <div class="modal-body">
                             <div class="row justify-content-md-center">
                                <fieldset class="col-md-10">
                                    <legend><h5>Account Details</h5></legend>
                                      <div class="form-group">
                                          <label class="form-label">Name:</label>
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
                                          <label class="form-label">Role</label>
                                              <select v-model="form.role" name="role"
                                              class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
                                                <option value="admin">ADMIN</option>
                                                <option value="accounts">ACCOUNTANT</option>
                                                <!-- <option value="driver">DRIVER</option> -->
                                              </select>
                                              <has-error :form="form" field="role"></has-error>
                                      </div>
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
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button :disabled="form.busy" type="submit" v-show="editmode" class="btn btn-sm btn-primary">Update</button>
                        <button :disabled="form.busy" type="submit" v-show="!editmode" class="btn btn-sm btn-primary">Submit</button>
                      </div>
                      </form>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
              <!-- end modal -->
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
        return {
          editmode: true,
          users: {},
          // user_id: '',
          form: new Form({
            id: '',
            name: '',
            email: '',
            role: '',
            password: '',
            confirm_password: '',
          })
        }
      },
      methods:{
        // show the user list from the database
        queryUsers(){
          axios.get('api/user').then(({ data})=>(this.users = data.data));
        },
        //execute the create user function
        createUser(){
          this.form.post('api/user').then(()=>{
            Toast.fire({
              type: 'success',
              title: 'User information saved successfully.'
            })
            this.form.reset();
            $('#modal-default').modal('hide');
            this.queryUsers();
          })
        },
        // update the user information
        updateUser(){
          this.$Progress.start();
            this.form.put('api/user/'+this.form.id).then(()=>{
              Toast.fire({
                type: 'success',
                title: 'User information updated successfully.'
              })
              this.form.reset();
              $('#modal-default').modal('hide');
              this.queryUsers();
            })
            .catch(()=>{
              this.$Progress.fail();
              Toast.fire({
                type: 'success',
                title: 'Oops!  User information failed to update.'
              })
            })
            this.$Progress.finish();
        },
        // show the update form modal
        updateForm(user){
          this.editmode = true;
          this.form.reset();
          this.form.clear();
          $('#modal-default').modal('show');
          this.form.fill(user);
        },
        //show the create form modal
        createForm(){
          this.editmode = false;
          this.form.reset();
          this.form.clear();
          $('#modal-default').modal('show');
        },
        //delete the user
        //delete vehicle function
        deleteUser(id){
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
                        this.form.delete('api/user/'+id).then(()=>{
                            swal.fire('Deleted!',
                            'Your record has been deleted.',
                            'success'
                            )            
                          this.queryUsers();                                             
                        }).catch(()=>{
                            swal.fire('Failed!', 'The operation could not complete', 'warning');
                        })                       
                    }                    
                    
            })                            
        }
      },
        created() {
            this.queryUsers();
        }
    }
</script>

<style scoped>
.table th, .table td {
    padding: 0.45em !important;
}

thead{
    color: #fff;
    background-color: #2a8ee0;
    font-size: 14px;
    padding: 0px;
    border: 1px solid #2a8ee0;
}
</style>

