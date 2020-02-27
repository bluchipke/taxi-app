<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $primaryKey = "invoice_id";

    protected $fillable = [
        'invoice_no', 'created_by', 'payment_status', 'invoice_amount', 'created_date', 'client_id'
    ];
}
