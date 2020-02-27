<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table border="1" style="width: 100%;">
                            <tr>
                                <td>CLIENT: {{this.client_id == 0 ? 'ALL CLIENTS' : client.client_desc}}</td>
                                <!-- <td>BEGINNING: {{ this.date1 | moment('MMMM Do YYYY') }}</td> -->
                                <!-- <td>ENDING: {{ this.date2 | moment('MMMM Do YYYY') }}</td> -->
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        
                        <table border="1" style="width: 100%; text-align: center;">
                            <tr>
                                <th>Item #</th>
                                <th>Invoice No.</th>
                                <th>Invoice Date:</th>
                                <th>Invoice Items</th>
                                <th>Invoice Amount</th>
                                <th>Tax</th>
                                <th>Total Amount</th>
                                <th>Invoice Status:</th>
                                
                            </tr>
                            <tr v-for="(d, index) in comms.data" :key="d.trip_id">
                                <td style=" text-align: center;">{{++index}}.</td>
                                <!-- <td v-show="d.invoiced == 0">
                                    <input v-model="form.trip_ids" :value="d.trip_id" type="checkbox" name="trip_ids[]" id="trips">                                   
                                </td> -->
                                <td>
                                    <router-link :to="'/reports/invoice/'+d.invoice_id">#{{d.invoice_no}}</router-link>
                                </td>
                                <td> <a href="#">{{d.created_date | moment('Do MMMM YYYY') }}</a> </td>
                                <td>{{d.trips}}</td>
                                <td>Ksh. {{d.amount | numFormat('0,0.00')}}</td>
                                <td>{{client.tax_rate}}%</td>
                                <td>Ksh. {{parseInt(d.amount) + (parseInt(d.amount) * client.tax_rate / 100) | numFormat('0,0.00')}}</td>
                                <td :style="d.payment_status == 0 ? 'background-color: red' : 'background-color: green'">{{d.payment_status == 0 ? 'NOT PAID ' : 'PAID'}}</td>
                               
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
                                <td><h6 style="font-size: 12px; font-weight: bold;">TOTAL AMOUNT:</h6></td>
                                <td><span style="float:right; font-weight: bold;">  Ksh {{tripAmount | numFormat('0,0.00')}} </span></td>
                            </tr>
                            <tr>
                                <td><h6 style="font-size: 12px; ">TOTAL TAX: <span style="float:right; ">  ({{client.tax_rate | numFormat('0,0.00')}} %) </span></h6></td>
                                <td><span style="float:right; ">  {{tax = tripAmount * (client.tax_rate / 100) | numFormat('0,0.00')}} </span></td>
                            </tr>   
                            <tr>
                                <td><h6 style="font-size: 12px; font-weight: bold;">TOTAL INVOICES AMOUNT:</h6></td>
                                <td><span style="float:right; font-weight: bold;">  Ksh {{tripAmount + tax | numFormat('0,0.00')}} </span></td>
                            </tr>                       
                        </table>

                           <hr>                       
                    </div>
                </div>
            </div>
        </div>
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
            axios.get('api/invoices').then(({data})=>{
                this.comms = data;
            })
        },
        getClient(){
            axios.get('api/organizations').then(({data})=>{
                this.client = data;
            })
        },
        generateInvoice(){
            this.form.post('api/invoices').then((data)=>{
                // this.info = data;
                // id
                this.invoice_id = data.data.invoice_id;
                window.open('/reports/invoices/'+this.client_id,'popUpWindow','height='+screen.height+',width='+screen.width+',left=100,top=100,resizable=no,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes');            
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
            var amt = this.comms.data.reduce((acc, amt) => acc + parseInt(amt.amount), 0);
            return parseInt(amt);
        },
    }
}
</script>
<style scoped>

</style>


