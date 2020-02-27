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
                            <div class="col-md-7">
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
                            <!-- <div class="col-md-2"> -->
                                <!-- <router-link :to="'/drivers/'+driver_id+'/schedule/create'" class="btn btn-xs btn-flat btn-primary btn-block">NEW SCHEDULE</router-link> -->
                            <!-- </div> -->
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
                                    <th>Code</th>
                                    <th>Distance</th>
                                    <th>Toll Fees:</th>
                                    <th>Fuel:</th>
                                    <th>Misc:</th>
                                    <th style="background-color: red;">Expenses:</th>
                                    <th>Amount</th>
                                    <th>Net</th>
                                    <th>Commission</th>
                                    <th style="background-color: green;">Income</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="d in schedules.data" :key="d.schedule_id">
                                    <td> <a href="#" @click.prevent="showSchedule(d)">{{d.sch_date}}</a></td>
                                    <td>{{d.public_id}}</td>
                                    <td>{{d.distance}}</td>
                                    <td class="float">{{d.toll  | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.fuel | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.misc | numFormat('0,0.00')}}</td>
                                    <td class="float">{{expenses = (parseInt(d.misc) + parseInt(d.toll) + parseInt(d.fuel)) | numFormat('0,0.00')}}</td>
                                    <td class="float">{{d.amount | numFormat('0,0.00')}}</td>
                                    <td class="float">{{net = d.amount - expenses | numFormat('0,0.00')}}</td>
                                    <td class="float">{{comm = net * (d.str_percent/100) | numFormat('0,0.00')}}</td>
                                    <td class="float">{{net - comm | numFormat('0,0.00')}}</td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="schedules" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
            <!-- modal window -->
                    <div class="modal fade in" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">UPDATE SCHEDULE</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                            </div>
                            <form @submit.prevent="updateSchedule" @keydown="form.onKeydown($event)" class="form-horizontal">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="" class="form-label col-md-3" >Schedule Code:</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="form.public_id" name="public_id" readonly class="form-control form-control-sm " :class="{ 'is-invalid': form.errors.has('public_id') }">
                                            <has-error :form="form" field="public_id"></has-error>
                                    </div>
                                </div>
                               <div class="form-group row">
                                <label for="" class="form-label col-md-3">Status:</label>
                                <div class="col-md-9">
                                    <select type="text" v-model="form.sch_status" name="sch_status" class="form-control" :class="{ 'is-invalid': form.errors.has('sch_status') }">
                                        <option value="">Select</option>
                                        <option value="OPEN">OPEN</option>
                                        <option value="CLOSED">CLOSED</option>
                                        <option value="CANCELLED">CANCELLED</option>
                                    </select>
                                        <has-error :form="form" field="sch_status"></has-error>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-flat btn-sm btn-primary">UPDATE</button>
                            </div>
                            </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

            <!-- end modal window -->
        </div>    
    </div>    
</template>
<script>
export default {
    data() {
        return {
            schedules: {},
            driver_id: this.$route.params.id,
            vsearch: '',
            expenses: 0,
            net: 0,
            comm: 0,
            form: new Form({
                schedule_id: '',
                public_id: '',
                sch_status: ''
            })
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
            axios.get('api/driver/'+this.driver_id+'/schedules').then(({ data})=>(this.schedules = data));
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.schedules = data
            ))
            .catch(()=>{

            })
            
        },
        showSchedule(d){
            $('#modal-default').modal('show');
            this.form.reset();
            this.form.fill(d);
        },
        updateSchedule(){

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

.float{
    text-align: right;
}
</style>
