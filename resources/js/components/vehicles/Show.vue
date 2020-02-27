<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <div class="row">
                    <div class="col-md-10">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">DETAILS</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">TRIPS</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">EXPENSES</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">INCOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">DRIVERS</a></li> -->
                        </ul>
                    </div>
                    <div class="col-md-1">
                        <router-link :to="'/vehicles/edit/'+vehicle.vehicle_id" class="btn btn-sm btn-flat btn-block btn-success"><i class="fa fa-edit"></i></router-link>
                    </div>
                     <div class="col-md-1">
                        <router-link :to="'/vehicles/edit/'+vehicle.vehicle_id" class="btn btn-sm btn-flat btn-block btn-danger"><i class="fa fa-trash"></i></router-link>
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
                                <p>General Information</p>
                                <!-- <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a> -->
                                </span>
                                <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                            </div>
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Number Plate: </strong>{{vehicle.number_plate}} </span></h6>
                              <h6><span><strong>Make #: </strong> {{vehicle.make}} </span></h6>
                              <h6><span><strong>Model: </strong> {{vehicle.model}} </span></h6>
                              <h6><span><strong>Color: </strong> {{vehicle.color}} </span></h6>
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Mileage: </strong> {{vehicle.mileage}} </span></h6>
                              <h6><span><strong>Gear Type.: </strong> {{vehicle.gear_type}} </span></h6>
                              <h6><span><strong>Chassis Number: </strong> {{vehicle.chassis_number}} </span></h6>
                              <h6><span><strong>Engine Number: </strong> {{vehicle.engine_number}} </span></h6>
                          </div>                          
                      </div>
                      <!-- /.user-block -->   
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="user-block" style="border-bottom: 2px solid #e3e3e3;">
                                <!-- <img class="img-circle img-bordered-sm" src="/img/user.png" alt="user image"> -->
                                <span class="username">
                                <p>Other Details</p>
                                <!-- <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a> -->
                                </span>
                                <!-- <span class="description">Shared publicly - 7:30 PM today</span> -->
                            </div>
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Capacity: </strong> {{vehicle.capacity}} </span></h6>
                              <h6><span><strong>Year of Manufacturing: </strong> {{vehicle.yom}} </span></h6>                              
                              <h6><span><strong>Origin: </strong> {{vehicle.origin}} </span></h6>  
                              <h6><span><strong>Condition: </strong> {{vehicle.condition}} </span></h6> 
                          </div>
                          <div class="col-sm-6">
                              <h6><span><strong>Policy Number: </strong> {{vehicle.policy_number}} </span></h6>
                              <h6><span><strong>Insurer #:</strong> {{vehicle.insurer}} </span></h6>
                              <h6><span><strong>Status #:</strong> {{vehicle.status}} </span></h6>
                              <h6><span><strong>Expiry Date: </strong> {{vehicle.insurance_expiry}} </span></h6>
                          </div>                          
                      </div>                                      
                    </div>
                    <!-- /.post -->                    

                  </div> 
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
</template>
<script>
export default {
    data(){
        return{
            vehicle:'',
            vehicle_id: this.$route.params.id,

        }
    },
    methods: {
        getVehicle(){
            axios.get('/api/vehicles/'+this.vehicle_id).then(({data})=>(
                this.vehicle = data
            ));
        },

    },
    mounted() {
            // this.$progress.start();
            this.getVehicle();
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


