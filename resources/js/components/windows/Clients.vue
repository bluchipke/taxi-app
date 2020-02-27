<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table border="1" style="width: 100%;">
                            <tr>
                                <td>CLIENT: {{this.client_id == 0 ? 'ALL CLIENTS' : client.client_desc}}</td>
                                <td>BEGINNING: {{ this.date1 | moment('MMMM Do YYYY') }}</td>
                                <td>ENDING: {{ this.date2 | moment('MMMM Do YYYY') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <form @submit.prevent="generateInvoice" @keydown="form.onKeydown($event)">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        
                        <table border="1" style="width: 100%;">
                            <tr>
                                <th>Item #</th>
                                <th></th>
                                <th>Date:</th>
                                <th>Staff</th>
                                <th>Organization</th>
                                <th>Pick Up:</th>
                                <th>Drop Off:</th>
                                <th>Date</th>
                                <th>Time Out</th>
                                <th>Time In</th>
                                <th>Distance</th>
                                <th>Charges:</th>
                            </tr>
                            <tr v-for="(d, index) in comms.data" :key="d.trip_id">
                                <td style=" text-align: center;">{{++index}}.</td>
                                <td v-show="d.invoiced == 0">
                                    <input v-model="form.trip_ids" :value="d.trip_id" type="checkbox" name="trip_ids[]" id="trips">                                   
                                </td>
                                <td v-show="d.invoiced == 1">
                                    <router-link :to="'/reports/invoice/'+d.invoice_id">INV</router-link>
                                </td>
                                <td> <a href="#">{{d.trip_date}}</a> </td>
                                <td>{{d.client_name}}</td>
                                <td>{{d.client_desc}}</td>
                                <td>{{d.start_point}}</td>
                                <td>{{d.end_point}}</td>
                                <td>{{d.trip_date | moment('Do MMMM YYYY')}}</td>
                                <td>{{d.time_out}}</td>
                                <td>{{d.time_in}}</td>
                                <td>{{d.distance}}</td>
                                <td class="float">{{ d.trip_amount | numFormat('0,0.00') }}</td>
                            </tr> 
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h6>CHARGES</h6>
                        <table border="1" style="width: 100%; ">
                            <tr>
                                <td><h6 style="font-size: 12px; font-weight: bold;">SUB TOTAL:</h6></td>
                                <td><span style="float:right; font-weight: bold;">  Ksh {{tripAmount | numFormat('0,0.00')}} </span></td>
                            </tr>
                            <tr>
                                <td><h6 style="font-size: 12px; ">TAX RATE: <span style="float:right; ">  ({{client.tax_rate | numFormat('0,0.00')}} %) </span></h6></td>
                                <td><span style="float:right; ">  {{tax = tripAmount * (client.tax_rate / 100) | numFormat('0,0.00')}} </span></td>
                            </tr>   
                            <tr>
                                <td><h6 style="font-size: 12px; font-weight: bold;">TOTAL AMOUNT:</h6></td>
                                <td><span style="float:right; font-weight: bold;">  Ksh {{tripAmount + tax | numFormat('0,0.00')}} </span></td>
                            </tr>                       
                        </table>

                           <hr>
                        <div class="inner justify-content-center" v-show="client_id != 0">
                            <button :disabled="form.busy" type="submit" class="btn btn-sm btn-flat btn-primary">GENERATE INVOICE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</template>
<script>

export default {
    data(){
        return {
            b: 1, 
            comms: {},
            client: [],
            tax: 0,     
            invoice_id: '', 
            info: {}      ,
            client_id : this.$route.params.id,
            date1: this.$route.params.from,
            date2: this.$route.params.to,
            form: new Form({
                trip_ids: [],
                client_id: this.$route.params.id,
            })
        }
    },
    methods:{
        getRecords(){
            axios.get('api/reports/clients/'+this.client_id+'/'+this.date1+'/'+this.date2).then(({data})=>{
                this.comms = data;
            })
        },
        getClient(){
            axios.get('api/organizations/'+this.client_id).then(({data})=>{
                this.client = data;
            })
        },
        generateInvoice(){
            this.form.post('api/invoices').then((data)=>{
                // this.info = data;
                // id
                this.invoice_id = data.data.invoice_id;
                window.open('/reports/invoice/'+this.invoice_id,'popUpWindow','height='+screen.height+',width='+screen.width+',left=100,top=100,resizable=no,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes');            
            })
        }

    },
    created(){
        this.$Progress.start();
        this.getClient();
        this.getRecords();
        this.$Progress.finish();
    },
    computed: {
        tripAmount() {                    
            var amount = this.comms.data.reduce((acc, amt) => acc + amt.trip_amount, 0);
            return parseInt(amount);
        },
    }
}
</script>
<style scoped>

</style>


