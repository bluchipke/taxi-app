<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;
    //
    protected $primaryKey = 'vehicle_id';

    protected $fillable = [
        'number_plate', 'make', 'model', 'color', 'body', 'seating', 'mileage', 'gear_type', 'chassis_number', 'engine_number', 'fuel_type', 'capacity', 'yom', 'origin', 'insurer', 'policy_number', 'condition', 'status', 'insurance_expiry'
    ];
}
