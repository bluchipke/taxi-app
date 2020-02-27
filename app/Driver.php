<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    //
    protected $primaryKey = 'driver_id';

    protected $fillable = [
      'user_id', 'title','first_name', 'last_name', 'driver_email', 'id_card', 'kra_pin', 'nssf', 'nhif', 'employee_code','department','phone_number','gender','marital_status','date_of_birth','county','estate','box_address','postal_code','town','job_title','date_started','employment_type','employment_status','next_of_kin','next_of_kin_email','next_of_kin_phone','relationship', 'commission'
    ];
}
