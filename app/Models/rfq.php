<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rfq extends Model
{
    use HasFactory;

    protected $fillable = ["rname", "remail", "rphone", "rcontent"];
    /* $table->text('rname');
            $table->text('remail');
            $table->text('rphone')->nullable();
            $table->text('rcontent')->nullable();*/
}
