<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    //
    protected $primaryKey = 'structure_id';

    protected $fillable = [
        'structure_id', 'str_label', 'str_amount', 'str_percent','str_status', 'str_notes'
    ];
}
