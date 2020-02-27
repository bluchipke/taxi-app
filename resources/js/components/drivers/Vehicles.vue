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
                                    <th>Registration:</th>
                                    <th>Trips:</th>
                                    <th>Distance:</th>
                                    <th>Toll:</th>
                                    <th>Fuel:</th>
                                    <th>Misc:</th>
                                    <th>Expenses</th>
                                    <th>Gross:</th>
                                    <th>Net:</th>
                                    <th>Commission</th>
                                    <th>Income</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d in schedules.data" :key="d.vehicle_id">
                                    <td> <router-link to="/to">{{d.number_plate}}</router-link> </td>
                                    <td>{{d.trips}}</td>
                                    <td>{{d.distance}}</td>
                                    <td style="float">{{d.toll| numFormat('0,0.00')}}</td>
                                    <td style="float">{{d.fuel| numFormat('0,0.00')}}</td>
                                    <td style="float">{{d.misc| numFormat('0,0.00')}}</td>
                                    <td style="float">{{ expenses = parseInt(d.toll) + parseInt(d.fuel) + parseInt(d.misc)| numFormat('0,0.00')}}</td>
                                    <td style="float">{{d.amount| numFormat('0,0.00')}}</td>
                                    <td style="float">{{net = d.amount - expenses| numFormat('0,0.00')}}</td>
                                    <td style="float">{{comm = net * (d.str_percent/100)| numFormat('0,0.00')}}</td>
                                    <td style="float">{{net - comm | numFormat('0,0.00')}}</td>
                                    
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="schedules" @pagination-change-page="getResults"></pagination>
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
            schedules: {},
            schedule_id: this.$route.params.id,
            vsearch: '',
            expenses: 0,
            net: 0,
            comm: 0,

        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/schedules?page=' + page)
				.then(response => {
					this.schedules = response.data;
				});
		},
        getSchedules(){
            axios.get('api/driver/'+this.schedule_id+'/vehicles').then(({ data})=>(this.schedules = data));
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.schedules = data
            ))
            .catch(()=>{

            })
            
        }
    },
    created(){
        this.$Progress.start();
        this.getSchedules();
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
