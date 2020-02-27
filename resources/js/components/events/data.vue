<template>
    <div class="row">
        <!-- Destination details  -->
        <div class="row">
        <div class="col-md-12">
                <h5>Trip Data</h5>
            <hr>
        </div>
    </div>                                                       
        <!-- </legend>   -->                                                                                     
    <div class="form-group row">
        <label for="" class="form-label col-md-3" >Total Time:</label>
            <div class="col-md-9">
            <input type="number" v-model="form.total_time" name="total_time" re class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('total_time') }">
                <has-error :form="form" field="total_time"></has-error>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="form-label col-md-3" >Total Distance:</label>
            <div class="col-md-9">
            <input type="number" width="100%" v-model="form.distance" name="distance" readonly class="form-control" :class="{ 'is-invalid': form.errors.has('distance') }">
                <has-error :form="form" field="distance"></has-error>
        </div>
    </div>  
    </div>
</template>
