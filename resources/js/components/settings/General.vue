<template>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <div class="row">
                    <div class="col-md-10">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">DETAILS</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">VEHICLES</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">TRIPS</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">COLLECTIONS</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">COMMISSIONS</a></li>
                        </ul>
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
                              <h6><span><strong>Commission Structure:</strong> {{driver.commission}} </span></h6>
                          </div>                          
                      </div>
                      <!-- /.user-block -->                   
                    </div>
                    <!-- /.post -->                    

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                          <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
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


