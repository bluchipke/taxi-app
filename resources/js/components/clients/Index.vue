<template>
    <div class="container">
        <div class="row" v-show="$gate.isAdminOrAccounts()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-7">
                                <h5>ORGANIZATIONS</h5>
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
                            <div class="col-md-2">
                                <router-link to="/organizations/create" class="btn btn-xs btn-flat btn-primary btn-block">NEW</router-link>
                            </div>                 
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Contact</th>
                                    <th>Account Number</th>
                                    <th>County</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d in clients" :key="d.client_id">
                                    <td><router-link :to="'/organizations/'+d.client_id+'/edit/'">{{d.client_desc}} </router-link></td>
                                    <td>{{d.client_phone}}</td>
                                    <td>{{d.account_number}}</td>
                                    <td>{{d.county}}</td>
                                    <td>{{d.client_status}}</td>
                                    
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- <pagination :data="clients" @pagination-change-page="getResults"></pagination> -->
                    </div>
                </div>
            </div>
        </div>    
        <div v-show="!$gate.isAdminOrAccounts()">
            <not-found></not-found>
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


