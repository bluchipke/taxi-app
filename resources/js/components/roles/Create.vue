<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="row">
                                <div class="col-xs-8 col-sm-8 col-md-8">
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        <input type="text" class="form-control form-control-sm" name="role_name" id="role_name">
                                    </div>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-8">
                                    <div class="form-group">
                                        <strong>Permission:</strong>
                                        <br/>
                                            <ul>
                                                <li v-for="permission in permissions" :key="permission.id">{{permission.name}}</li>
                                            </ul>
                                            <input class="checkbox" type="checkbox" v-for="permission in permissions" v-bind:value="permission.name" v-text="permission.name" :key="permission.id"/>
                                            
                                        <br/>
                                    </div>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-8">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
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
         permissions: {},
     }
 },
 methods: {
     getPermissions(){
         axios.get('api/permissions').then(({ data})=>(this.permissions = data));
     }
 },
 created() {
     this.getPermissions();
 }

}
</script>

<style scoped>

</style>


