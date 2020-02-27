<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'vehicle_id', 'driver_id', 'sch_status', 'sch_date', 'created_by', 'opened', 'sc_closed', 'opening_mileage', 'closing_mileage', 'fuel_amount', 'comments', 'closed_by'
    ];
}
