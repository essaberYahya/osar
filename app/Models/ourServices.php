<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ourServices extends Model
{
    use HasFactory;

    /**
        *  $table->id();
            $table->text("title");
            $table->text("icon");
            $table->text("description");
            $table->text("color");
        */

    protected $fillable = ["title","icon","description","color"];
}
