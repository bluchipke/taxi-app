<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    //
    protected $primaryKey = 'trip_id';

    protected $fillable = [
        'client_name', 'organization_id', 'trip_status', 'completed', 'driver_id', 'start_point', 'end_point', 'vehicle_id', 'mileage_out', 'mileage_in', 'distance', 'schedule_id', 'time_out', 'time_in', 'total_time', 'trip_date', 'payment_method', 'payment_code', 'trip_amount', 'toll_fees', 'trip_misc', 'fuel_expense', 'closed', 
    ];
}
