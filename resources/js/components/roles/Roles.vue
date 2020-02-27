<template>
    <div class="container">
        <div class="row">          
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                      <p>ROLE MANAGEMENT</p>    
                    </div>
                    <div class="col-md-6">   
                        <!-- <button class="btn btn-sm btn-primary float-right">NEW EMPLOYEE</button> -->
                        <router-link to="/roles/create" class="btn btn-sm btn-info float-right">NEW ROLE</router-link>
                        <!-- <button class="btn btn-sm btn-primary float-right">EXPORT EXCEL</button> -->
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                  <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Department</th>
                    <th>Active</th>
                    <th>Actions</th>
                  </tr> 
                 <tr v-for="role in roles" :key="role.id">                 
                  
                    <td>{{role.id}}</td>
                    <td>{{role.name}}</td>
                    <td>{{role.guard_name}}</td>
                    <td><span class="tag tag-warning">Admin</span></td>
                    <td>ICT</td>
                    <td>Active</td>
                    <td>
                      <div class="row">
                        <div class="col-md-4">
                          <a href="#"><i class="fa fa-eye"></i></a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
</template>

<script>
    export default {
      data() {
        return {
          roles: {},
        }
      },
      methods:{
        queryRoles(){

          axios.get('api/roles').then(({ data})=>(this.users = data.data));
        }
      },
        created() {
            this.queryRoles();
        }
    }
</script>

<style scoped>
.table th, .table td {
    padding: 0.45em !important;
}
</style>

