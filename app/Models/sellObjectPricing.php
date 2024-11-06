<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sellObjectPricing extends Model
{
    use HasFactory;

    /**
     *  $table->integer("object_id");
            $table->float("price");
            $table->text("description");
            $table->text("htmlPart");
            $table->text("name");
            $table->text("icon");
     */

     protected $fillable = ["object_id","price","description","htmlPart","name","icon"];
}
