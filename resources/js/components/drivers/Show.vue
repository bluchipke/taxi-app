<template>
    <div class="contai">
      <div class="row">
            <div class="col-md-12">
                <div class="card">
                        <nav-bar></nav-bar>
                </div>
            </div>
      </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <div class="row"> 
                    <div class="col-md-10">
                        <h4 style="text-transform: uppercase;">DRIVER: {{driver.first_name}} {{driver.last_name}}</h4>
                    </div>                  
                    <div class="col-md-1">
                        <router-link :to="'/drivers/edit/'+driver.driver_id" class="btn btn-sm btn-flat btn-block btn-success"><i class="fa fa-edit"></i></router-link>
                    </div>
                     <div class="col-md-1">
                        <router-link :to="'/drivers/edit/'+driver.driver_id" class="btn btn-sm btn-flat btn-block btn-danger"><i class="fa fa-trash"></i></router-link>
                    </div>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="user-block" style="border-bottom: 2px solid #e3e3e3;">
                                <!-- <img class="img-circle img-bordered-sm" src="/img/user.png" alt="user image"> -->
                                <span class="username">
                                <p>Personal Information</p>
                                <!-- <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a> -->
                                </span>
                                <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                            </div>
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Name: </strong>{{driver.title}} {{driver.first_name}} {{driver.last_name}} </span></h6>
                              <h6><span><strong>ID #: </strong> {{driver.id_card}} </span></h6>
                              <h6><span><strong>Employee Code: </strong> {{driver.employee_code}} </span></h6>
                              <h6><span><strong>Gender: </strong> {{driver.gender}} </span></h6>
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Marital Status: </strong> {{driver.marital_status}} </span></h6>
                              <h6><span><strong>DOB #.: </strong> {{driver.date_of_birth}} </span></h6>
                              <h6><span><strong>NHIF: </strong> {{driver.nhif}} </span></h6>
                              <h6><span><strong>KRA Pin: </strong> {{driver.kra_pin}} </span></h6>
                          </div>                          
                      </div>
                      <!-- /.user-block -->   
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="user-block" style="border-bottom: 2px solid #e3e3e3;">
                                <!-- <img class="img-circle img-bordered-sm" src="/img/user.png" alt="user image"> -->
                                <span class="username">
                                <p>Contact Information</p>
                                <!-- <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a> -->
                                </span>
                                <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                            </div>
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Phone Number: </strong> {{driver.phone_number}} </span></h6>
                              <h6><span><strong>Email: </strong> {{driver.driver_email}} </span></h6>                              
                              <h6><span><strong>Postal Address: </strong> {{driver.box_address}} </span></h6>  
                              <h6><span><strong>Postal Code: </strong> {{driver.postal_code}} </span></h6> 
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Next of Kin: </strong> {{driver.next_of_kin}} </span></h6>
                              <h6><span><strong>Phone #:</strong> {{driver.next_of_kin_phone}} </span></h6>
                              <h6><span><strong>Email Address: </strong> {{driver.next_of_kin_email}} </span></h6>
                              <h6><span><strong>Relationship:</strong> {{driver.relationship}} </span></h6>
                          </div>                          
                      </div>
                      <!-- /.user-block -->       
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="user-block" style="border-bottom: 2px solid #e3e3e3;">
                                <!-- <img class="img-circle img-bordered-sm" src="/img/user.png" alt="user image"> -->
                                <span class="username">
                                <p>Employment Information</p>
                                <!-- <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a> -->
                                </span>
                                <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                            </div>
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Employment Type: </strong> {{driver.employment_type}} </span></h6>
                              <h6><span><strong>Employment Status: </strong> {{driver.employment_status}} </span></h6>                              
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Date Started: </strong> {{driver.date_started}} </span></h6>
                              <h6><span><strong>Commission Structure:</strong> {{driver.str_label}}({{driver.str_percent}}% + KSH {{driver.str_amount}}) </span></h6>
                          </div>                          
                      </div>
                      <!-- /.user-block -->                   
                    </div>
                    <!-- /.post -->                    

                  </div>  
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</template>
<script>
export default {
    data(){
        return{
            driver:'',
            driver_id: this.$route.params.id,

        }
    },
    methods: {
        getDriver(){
            axios.get('api/drivers/'+this.driver_id).then(({data})=>(
                this.driver = data
            ));
        },

    },
    mounted() {
            // this.$progress.start();
            this.getDriver();
            // this.$progress.finish();
        }
}
</script>
<style scoped>
.user-block .username, .user-block .description, .user-block .comment {
    margin-left: 0px;
    color: #3490dc;
}
</style>


