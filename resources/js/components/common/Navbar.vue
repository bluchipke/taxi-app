<template>
    <div class="col-md-10 mb-2 mt-2" v-show="$gate.isAdminOrAccounts()">
        <ul class="nav nav-pills">
            <li class="nav-item"><router-link class="nav-link" :to="'/drivers/show/'+driver_id">DETAILS</router-link></li>
            <li class="nav-item"><router-link class="nav-link" :to="'/drivers/'+driver_id+'/vehicles'">VEHICLES</router-link></li>
            <li class="nav-item"><router-link class="nav-link" :to="'/drivers/'+driver_id+'/trips'">TRIPS</router-link></li> 
            <li class="nav-item"><router-link class="nav-link" :to="'/drivers/'+driver_id+'/collections'">COLLECTIONS</router-link></li>          
            <li class="nav-item"><router-link class="nav-link" :to="'/drivers/'+driver_id+'/commissions'">COMMISSIONS</router-link></li>
            <li class="nav-item"><router-link class="nav-link" :to="'/drivers/'+driver_id+'/schedules'">SCHEDULES</router-link></li>
        </ul>
    </div>
</template>
<script>
export default {
    data(){
        return{
            driver: '',
            driver_id: this.$route.params.id
        }
    }

}
</script>
<style scoped>
.router-link-exact-active {
    color: #ffffff;
}
</style>


