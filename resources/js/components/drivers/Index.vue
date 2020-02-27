<template>
    <div class="contai">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-5">
                                <h5>DRIVERS</h5>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-3">
                                <!-- SEARCH FORM -->
                                <div class="form-inline ml-3">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" v-model="vsearch" @keyup="searchV" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </div>
                                </div>
                                </div>
                            </div>                            
                            <div class="col-md-2">
                                <router-link to="/drivers/create" class="btn btn-xs btn-flat btn-primary btn-block">NEW DRIVER</router-link>
                            </div>               
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Full Name.</th>
                                    <th>ID Card</th>
                                    <!-- <th>KRA Pin</th> -->
                                    <th>Employee Code</th>
                                    <!-- <th>Mobile No.</th> -->
                                    <th>Date Started</th>
                                    <th>Employment Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d in drivers.data" :key="d.driver_id">
                                    <td><router-link :to="'/drivers/show/'+d.driver_id">{{d.first_name}} {{d.last_name}}</router-link></td>
                                    <td>{{d.id_card}}</td>
                                    <!-- <td>{{d.kra_pin}}</td> -->
                                    <td>{{d.employee_code}}</td>
                                    <!-- <td>{{d.phone_number}}</td> -->
                                    <td>{{d.date_started}}</td>
                                    <td>{{d.employment_type}}</td>
                                    <td>{{d.employment_status}}</td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="drivers" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>    
    </div>    
</template>
<script>
export default {
    data() {
        return {
            drivers: {},
            vsearch: ''
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/drivers?page=' + page)
				.then(response => {
					this.drivers = response.data;
				});
		},
        getDrivers(){
            axios.get('api/drivers').then(({ data})=>(this.drivers = data));
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.drivers = data
            ))
            .catch(()=>{

            })
            
        }
    },
    created(){
        this.$Progress.start();
        this.getDrivers();
        this.$Progress.finish();
    }
}
</script>
<style scoped>
thead{
    color: #fff;
    background-color: #2a8ee0;
    font-size: 14px;
    padding: 0px;
    border: 1px solid #2a8ee0;
}

.table th, .table td {
    padding: 0.4rem 1.3rem;
}

.table td {
    font-size: 12px;
}

.table-fixed{
  width: 100%;
  background-color: #f3f3f3;
}
  

</style>


