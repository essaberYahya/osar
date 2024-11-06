<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class intro extends Model
{
    use HasFactory;

    protected $fillable = ["backgroundimg","title","description","htmlPart"];

    /**
     *  $table->text("backgroundimg")->default("");
            $table->text("title")->nullable();
            $table->text("description")->nullable();
            $table->text("htmlPart");
     */
}
