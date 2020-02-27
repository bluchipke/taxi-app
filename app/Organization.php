<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    //
    use SoftDeletes;
    
    protected $primaryKey = 'client_id';

    protected $fillable = [
        'client_desc', 'login_id', 'client_phone', 'client_email', 'client_status', 'client_address', 'company_size', 'client_notes', 'county', 'account_number', 'industry', 'client_pin', 'tax_rate'
    ];
}
