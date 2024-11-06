<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rfqObejects extends Model
{
    use HasFactory;

    protected $fillable = ["rfq_id", "object_id"];

    /**
     *   $table->bigInteger('rfq_id')->unsigned();
            $table->bigInteger('object_id')->unsigned();
     */
}
