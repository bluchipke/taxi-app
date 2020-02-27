<template>
    
</template>
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-7">
                                <h5>BOOKINGS MODULE</h5>
                            </div>
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
                            <div class="col-md-2" v-show="$gate.isClient()">
                                <router-link to="/bookings/create" class="btn btn-xs btn-flat btn-primary btn-block">NEW BOOKING</router-link>
                            </div>                 
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>#Index</th>
                                    <th>Date</th>
                                    <th>Employee Name</th>
                                    <th>Contact</th>
                                    <th>Pick Up</th>
                                    <th>Drop Off</th>
                                    <th>Pick Up Time</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>                          
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- <h5>This module is coming soon!</h5> -->
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
            clients: {},
            vsearch: ''
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/organizations?page=' + page)
				.then(response => {
					this.clients = response;
				});
		},
        getClients(){
            axios.get('api/organizations').then(({ data})=>(
                this.clients = data
                ));
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.clients = data
            ))
            .catch(()=>{

            })
            
        }
    },
    created(){
        this.$Progress.start();
        this.getClients();
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


