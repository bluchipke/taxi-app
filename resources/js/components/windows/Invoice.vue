<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <!-- <div class="card">
                        <div class="card-body"> -->
                            <table border="0" style="width: 100%;">
                                <tr>
                                    <!-- <td>INVOICE NO: {{ invoice.invoice_no}}</td> -->
                                    <!-- <td>CLIENT: {{ invoice.client_desc}}</td> -->
                                    <!-- <td>BEGINNING: {{ this.date1 | moment('MMMM Do YYYY') }}</td> -->
                                    <!-- <td>ENDING: {{ this.date2 | moment('MMMM Do YYYY') }}</td> -->
                                </tr>
                            </table>
                        <!-- </div>
                    </div> -->
                    <address>
                        <h5>BLUCHIP SOLUTIONS</h5>
                     <p>P.O BOX 40012 - 00100<br>
                        NAIROBI, KENYA <br>
                        TEL 1: 0716 160 284<br>
                        TEL 2: 0716 160 284</p>
                    </address>
                    <hr>
                    <address>
                        <h5 style="text-transform: uppercase;">{{invoice.client_desc}}</h5>
                     <p>P.O BOX {{invoice.client_address}}<br>
                        <!-- NAIROBI, KENYA <br> -->
                        TEL 1: {{invoice.client_phone}}<br>
                        <!-- TEL 2: 0716 160 284 -->
                        </p>
                    </address>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <!-- <div class="card">
                        <div class="card-body"> -->
                            <table border="0" style="width: 100%;">
                                <tr>
                                    <td style="text-align: right"><h3>INVOICE</h3></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><h6>INVOICE NO: #{{ invoice.invoice_no}}</h6></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right"><h6>DATE: {{ invoice.created_date | moment('DD MMMM YYYY')}}</h6></td>
                                </tr>
                            </table>
                            <table border="0" style="width: 100%;">
                                <tr>
                                    <td style="text-align: right" v-show="invoice.payment_status == 0"><h3 style="background-color: red; color: #fff;">NOT PAID</h3></td>
                                    <td style="text-align: right" v-show="invoice.payment_status == 1"><h3 style="background-color: green; color: #fff;">PAID</h3></td>
                                </tr>                                
                            </table>
                        <!-- </div>
                    </div> -->
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="card">
                        <div class="card-body"> -->
                            
                            <table border="1" style="width: 100%;">
                                <tr>
                                    <th>Item #</th>
                                    <th>Date:</th>
                                    <th>Staff</th>
                                    <!-- <th>Organization</th> -->
                                    <th>Pick Up:</th>
                                    <th>Drop Off:</th>
                                    <th>Date</th>
                                    <th>Time Out</th>
                                    <th>Time In</th>
                                    <th>Distance</th>
                                    <th>Charges:</th>
                                </tr>
                                <tr v-for="(d, index) in comms" :key="d.trip_id">
                                    <td style=" text-align: center;">{{++index}}.</td>
                                    <td> <a href="#">{{d.trip_date}}</a> </td>
                                    <td>{{d.client_name}}</td>
                                    <!-- <td>{{d.client_desc}}</td> -->
                                    <td>{{d.start_point}}</td>
                                    <td>{{d.end_point}}</td>
                                    <td>{{d.trip_date | moment('DD MMMM YYYY')}}</td>
                                    <td>{{d.time_out}}</td>
                                    <td>{{d.time_in}}</td>
                                    <td>{{d.distance}}</td>
                                    <td class="float">{{ d.trip_amount | numFormat('0,0.00') }}</td>
                                </tr> 
                            </table>
                            
                        <!-- </div>
                    </div> -->
                </div>
            </div>
            &nbsp;
            &nbsp;
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
                                    <td><h6 style="font-size: 12px; ">TAX RATE: <span style="float:right; ">  ({{invoice.tax_rate | numFormat('0,0.00')}} %) </span></h6></td>
                                    <td><span style="float:right; ">  {{tax = tripAmount * (invoice.tax_rate / 100) | numFormat('0,0.00')}} </span></td>
                                </tr>   
                                <tr>
                                    <td><h6 style="font-size: 12px; font-weight: bold;">TOTAL AMOUNT:</h6></td>
                                    <td><span style="float:right; font-weight: bold;">  Ksh {{tripAmount + tax | numFormat('0,0.00')}} </span></td>
                                </tr>                       
                            </table>

                            <hr>
                            <!-- <div class="inner justify-content-center" v-show="invoice_id != 0">
                                <button :disabled="form.busy" type="submit" class="btn btn-sm btn-flat btn-primary">GENERATE INVOICE</button>
                            </div> -->
                        </div>
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
            invoice: [],
            tax: 0,     
            info: {}      ,
            invoice_id : this.$route.params.id,            
            
        }
    },
    methods:{
        getRecords(){
            axios.get('api/reports/invoice/'+this.invoice_id).then(({data})=>{
                this.comms = data.data;
            })
        },
        getInvoice(){
            axios.get('api/invoices/'+this.invoice_id).then(({data})=>{
                this.invoice = data;
            })
        },
        generateInvoice(){
            this.form.post('api/invoices').then(({data})=>{
                this.info = data;
            })
        }

    },
    created(){
        this.$Progress.start();
        this.getInvoice();
        this.getRecords();
        this.$Progress.finish();
    },
    computed: {
        tripAmount() {                    
            var amt = this.comms.reduce((acc, amt) => acc + amt.trip_amount, 0);
            return parseInt(amt);
        },
    }
}
</script>
<style scoped>

</style>


