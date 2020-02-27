<template>
    <div class="container">
        <!-- element elements -->
            
        <!-- end element -->
        <div class="row" v-show="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-5">
                                <h5>COMMISSION STRUCTURES</h5>
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
                                <router-link to="/settings/structures/create" class="btn btn-xs btn-flat btn-primary btn-block">NEW STRUCTURE</router-link>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-xs btn-flat btn-success btn-block" @click.prevent="speakUp">EXCEL</button>
                            </div>                           
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-fixed">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Label</th>
                                    <th>Percent (%)</th>
                                    <th>Amount (Ksh)</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(d, index) in structures.data" :key="d.structure_id">
                                    <td>{{++index}}</td>
                                    <td><router-link :to="'/settings/structures/edit/'+d.structure_id">{{d.str_label}} </router-link></td>
                                    <td>{{d.str_percent}}</td>
                                    <td>{{d.str_amount}}</td>
                                    <td>{{d.str_status}}</td>
                                    
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="structures" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>   
        <div v-show="!$gate.isAdmin()">
            <not-found></not-found>
        </div> 
    </div>    
</template>
<script>
export default {
    data() {
        const item = {
            date: '2016-05-02',
            name: 'Tom',
            address: 'No. 189, Grove St, Los Angeles'
        };
        return {
            structures: {},
            vsearch: '',
            tableData: Array(5).fill(item),
        }
    },
    methods: {
        getResults(page = 1) {
			axios.get('api/structures?page=' + page)
				.then(response => {
					this.structures = response.data;
				});
		},
        getstructures(){
            axios.get('api/structures').then(({ data})=>(this.structures = data));
        },
        speakUp(){
            var msg = new SpeechSynthesisUtterance();
            var voices = window.speechSynthesis.getVoices();
            msg.voice = voices[1]; // Note: some voices don't support altering params
            msg.voiceURI = 'native';
            msg.volume = 1; // 0 to 1
            msg.rate = 0.8; // 0.1 to 10
            msg.pitch = 1; //0 to 2
            msg.text = 'Ticket Number CD014 Counter Number 3';
            msg.lang = 'en-US';
            window.speechSynthesis.speak(msg);
        },
        searchV(){
            let query = this.vsearch;

            axios.get('api/findVehicle?q='+query)
            .then(({data})=>(
                this.structures = data
            ))
            .catch(()=>{

            })
            
        }
    },
    created(){
        this.$Progress.start();
        this.getstructures();
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


