<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class softLicence extends Model
{
    use HasFactory;

    protected $with = ["accessRight"];

    public function accessRight(){
        return $this->belongsTo("\App\Models\softAccessRight","id","softLicenceId");
    }
}
