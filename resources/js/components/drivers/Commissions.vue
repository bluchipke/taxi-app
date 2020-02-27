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
                                <h5>DRIVER SCHEDULES</h5>
                            </div>
                            <div class="col-md-3">
                                <!-- SEARCH FORM -->
                                <div class="form-inline ml-3">
                                <div class="input-group input-group-sm">
                                    <!-- <input class="form-control form-control-navbar" type="search" v-model="vsearch" @keyup="searchV" placeholder="Search" aria-label="Search"> -->
                                    <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <!-- <router-link :to="'/drivers/'+schedule_id+'/schedule/create'" class="btn btn-xs btn-flat btn-primary btn-block">NEW SCHEDULE</router-link> -->
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
                                    <th>Organization</th>
                                    <th>Pick:</th>
                                    <th>Drop:</th>
                                    <th>Expenses:</th>
                                    <th>Amount:</th>
                                    <th>Net:</th>
                                    <th>Commission:</th>
                                    <th>Income:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d in commissions.data" :key="d.trip_id">
                                    <td> <router-link to="/to">{{d.trip_date}}</router-link> </td>
                                    <td>{{d.client_desc}}</td>
                                    <td>{{d.start_point}}</td>
                                    <td>{{d.end_point}}</td>
                                    <td class="float">{{expenses = (d.toll_fees + d.trip_misc + d.fuel_expense) | numFormat('0,0.00') }}</td>
                                    <td class="float">{{d.trip_amount | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.trip_amount - (d.toll_fees + d.trip_misc + d.fuel_expense) | numFormat('0,0.00')}}</td>
                                    <td class="float">{{commission = (d.trip_amount - (d.toll_fees + d.trip_misc + d.fuel_expense)) * (d.str_percent/100) | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.trip_amount - (expenses+commission) | numFormat('0,0.00')}}</td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <!-- <pagination :data="commissions" @pagination-change-page="getResults"></pagination> -->
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
            expenses: 0,
            commission: 0,
            commissions: {},
            driver_id: this.$route.params.id,
            vsearch: ''
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/commissions?page=' + page)
				.then(response => {
					this.commissions = response.data;
				});
		},
        getCommissions(){
            axios.get('api/driver/'+this.driver_id+'/commissions').then(({ data})=>(this.commissions = data));
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.commissions = data
            ))
            .catch(()=>{

            })
            
        }
    },
    created(){
        this.$Progress.start();
        this.getCommissions();
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

.float{
    text-align: right;
}
</style>
