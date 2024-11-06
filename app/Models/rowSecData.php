<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rowSecData extends Model
{
    use HasFactory;

    /**
         *  $table->text("title");
            $table->text("description");
            $table->text("picture");
            $table->text("htmlPart");
            $table->boolean("leftToRight")->default(0);
         */

    protected $fillable = ["title","description","picture","htmlPart","leftToRight"];
}
