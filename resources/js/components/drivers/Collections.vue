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
                    <div class="card-header">
                        <div class="row">                             
                            <div class="col-md-5">
                                <h5>DRIVER COLLECTIONS</h5>
                            </div>
                            <div class="col-md-3">
                                <!-- SEARCH FORM -->
                                <div class="form-inline ml-3">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" v-model="search" @keyup="searchV" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <router-link :to="'/drivers/'+schedule_id+'/schedule/create'" class="btn btn-xs btn-flat btn-primary btn-block">NEW SCHEDULE</router-link>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-xs btn-flat btn-success btn-block">EXCEL</button>
                            </div>                           
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Date:</th>
                                    <th>Schedule</th>
                                    <th>Client:</th>
                                    <th>Pick:</th>
                                    <th>Drop:</th>
                                    <th>Toll</th>
                                    <th>Fuel</th>
                                    <th>Misc</th>
                                    <th>Amount</th>
                                    <th>Net</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d in collections.data" :key="d.trip_id">
                                    <td> <router-link to="/to">{{d.trip_date}}</router-link> </td>
                                    <td>{{d.public_id}}</td>
                                    <td>{{d.client_desc}}</td>
                                    <td>{{d.start_point}}</td>
                                    <td>{{d.end_point}}</td>
                                    <td class="float">{{d.toll_fees | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.fuel_expense | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.trip_misc | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.trip_amount | numFormat('0,0.00')}}</td>
                                    <td class="float">{{(d.trip_amount - (d.toll_fees + d.trip_misc + d.fuel_expense)) | numFormat('0,0.00')}}</td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="collections" @pagination-change-page="getResults"></pagination>
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
            total_amount: 0,
            net_amount: '',
            collections: {},
            schedule_id: this.$route.params.id,
            search: '',
            results: []
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/collections?page=' + page)
				.then(response => {
					this.collections = response.data;
				});
		},
        getCollections(){
            axios.get('api/driver/'+this.schedule_id+'/collections').then(({ data})=>(this.collections = data));
        },
        searchV(){
            let query = this.search;

            axios.get('api/sortCollections?q='+query)
            .then(({data})=>(
                this.collections = data
            ))
            .catch(()=>{

            })
            
        }
    },
    created(){
        this.$Progress.start();
        this.getCollections();
        this.$Progress.finish();
    },
    computed: {

    tollFees() {
        // this.results = this.collections.data;
        var toll = this.collections.data.reduce((acc, toll) => acc + toll.toll_fees, 0);

        return parseInt(toll);
    },
    tripMisc() {
                
        var misc = this.collections.data.reduce((acc, misc) => acc + misc.trip_misc, 0);
        return parseInt(misc);
    },
    tripAmount() {
                
        var amount = this.collections.data.reduce((acc, amt) => acc + amt.trip_amount, 0);
        return parseInt(amount);
    },
    fuelAmount(){

        var fuel = this.collections.data.reduce((acc, fuel) => acc + fuel.fuel_expense, 0); 
        return parseInt(fuel);       
    }
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
