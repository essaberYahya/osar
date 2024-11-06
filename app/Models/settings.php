<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;

    protected $fillable = ["logo","facebook","whatsapp","instagram","twitter","phone","fix","adress","email","content"];

    /**
     *      $table->text("logo");
            $table->text("facebook");
            $table->text("whatsapp");
            $table->text("instagram");
            $table->text("twitter");
            $table->text("phone");
            $table->text("fix");
            $table->text("adress");
            $table->text("email");
            $table->text("content");
     */
}
