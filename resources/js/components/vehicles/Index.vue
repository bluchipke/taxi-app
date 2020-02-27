<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-5">
                                <h5>VEHICLES</h5>
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
                                <router-link to="/vehicles/create" class="btn btn-xs btn-flat btn-primary btn-block">NEW VEHICLE</router-link>
                            </div>
                                                    
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Reg.</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Color</th>
                                    <th>Body</th>
                                    <th>Passengers</th>
                                    <th>Insurer</th>
                                    <th>Policy #</th>
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="v in vehicles.data" :key="v.vehicle_id">
                                    <td><router-link :to="'/vehicles/show/'+v.vehicle_id">{{v.number_plate}}</router-link></td>
                                    <td>{{v.make}}</td>
                                    <td>{{v.model}}</td>
                                    <td>{{v.color}}</td>
                                    <td>{{v.body}}</td>
                                    <td>{{v.seating}}</td>
                                    <td>{{v.insurer}}</td>
                                    <td>{{v.policy_number}}</td>
                                    <!-- <td>{{v.status}}</td> -->
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="vehicles" @pagination-change-page="getResults"></pagination>
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
            vehicles: {},
            vsearch: ''
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/vehicles?page=' + page)
				.then(response => {
					this.vehicles = response.data;
				});
		},
        getVehicles(){
            axios.get('api/vehicles').then(({ data})=>(this.vehicles = data));
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.vehicles = data
            ))
            .catch(()=>{

            })
            
        }
    },
    created(){
        this.$Progress.start();
        this.getVehicles();
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


