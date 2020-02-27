<template>
    <div class="container">
        <!-- <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard Component</div>

                    <div class="card-body">
                        This is the application dashboard for your information.
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Info boxes -->
        <div class="row" v-show="$gate.isAdminOrAccounts()">          
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-taxi"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">OPEN WORK SHEETS</span>
                <!-- <span class="info-box-number">1</span> -->
                <router-link to="/schedules" class="btn btn-flat btn-md btn-danger">VIEW ALL</router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

         
          <!-- /.col -->
        <!-- </div> -->
        <!-- /.row -->

        <!-- <div class="row" v-show="$gate.isAdminOrAccounts()"> -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-calculator"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">COMMISSIONS</span>
                <span class="info-box-number">
                  <!-- 10 -->
                  <!-- <small>%</small> -->
                </span>
                  <router-link to="/reports/commissions" class="btn btn-flat btn-md btn-info">GENERATE</router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-car"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CLOSED WORK SHEETS</span>
                <!-- <span class="info-box-number">2</span> -->
                <router-link to="/schedules/closed" class="btn btn-flat btn-md btn-danger">VIEW ALL</router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-calendar-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">BOOKINGS</span>
                <!-- <span class="info-box-number">1</span> -->
                <router-link to="/bookings" class="btn btn-flat btn-md btn-danger">VIEW ALL</router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
        </div>
        <!-- /.row -->
        <div class="row" v-show="$gate.isDriver()">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-car"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">MY TRIPS</span>
                <span class="info-box-number">
                  <!-- 10
                  <small>%</small> -->
                </span>
                <router-link to="/trips" class="btn btn-flat btn-md btn-info">VIEW ALL</router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">WORKSHEETS</span>
                <!-- <span class="info-box-number">10</span> -->
                <router-link to="/schedules" class="btn btn-flat btn-md btn-danger">VIEW ALL</router-link>
              </div>
              
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row" v-show="$gate.isDriver()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                DRIVER DASHBOARD
              </div>
              <div class="card-body" v-show="trips < 1">
                <div class="row">
                  <div class="col-md-2">
                    <router-link to="/driver/start/trip" class="btn btn-flat btn-lg btn-primary">START TRIP</router-link>
                  </div>
                </div>
              </div>
              <div class="card-body" v-show="trips > 0">
                 <div class="row">
                  <div class="col-md-2">
                    <router-link to="/trips" class="btn btn-flat btn-lg btn-primary">CONTINUE</router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" v-show="$gate.isClient()">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-car"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TRIPS</span>
                <!-- <span class="info-box-number">
                  10
                  <small>%</small>
                </span> -->
                <router-link to="/trips" class="btn btn-flat btn-md btn-info">VIEW ALL</router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col --> 
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-sticky-note"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">INVOICES</span>
                <!-- <span class="info-box-number">
                  10
                  <small>%</small>
                </span> -->
                <router-link to="/invoices" class="btn btn-flat btn-md btn-primary">VIEW ALL</router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-calendar-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">BOOKINGS</span>
                <!-- <span class="info-box-number">
                  10
                  <small>%</small>
                </span> -->
                <router-link to="/bookings" class="btn btn-flat btn-md btn-success">VIEW ALL</router-link>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
    </div>
</template>

<script>
    export default {
      data() {

        return {
          trips: 0,
        }
      },

      methods: {
            getCurrentTrips(){
              axios.get('api/driver/trips')
              .then(({data})=>(
                  this.trips = data
              ))
              .catch(()=>{
                  Toast.fire({
                      type: 'warning',
                      title: 'An error occurred. Could not retrieve records.'
                  })
              })            
          },
          getOpenChedule(){

          }
      },
        mounted() {
            this.$Progress.start();
            this.getCurrentTrips();
            this.$Progress.finish();
        }
    }
</script>
