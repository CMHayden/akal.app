<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class layout extends Model
{
    protected $fillable = [
        'patientEmail',
        'layout'
    ];
}
