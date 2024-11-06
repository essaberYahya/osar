<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sellObject extends Model
{
    use HasFactory;

      /**
         *  $table->text("title");
            $table->text("description");
            $table->text("htmlPart");
            $table->text("pictureCover");
            $table->integer("category_id")->unsigned();
            $table->date("startAt");
            $table->date("EndDate");
         */

    protected $fillable = ["title","description","htmlPart","pictureCover","category_id","startAt","EndDate"];

    protected $with = ["category","pps","album"];

    public function category(){
        return $this->belongsTo("\App\Models\projectCategory","category_id","id");
    }

    public function pps(){
        return $this->hasMany("\App\Models\sellObjectPricing",'object_id','id');
    }

    public function album(){
        return $this->hasMany('\App\Models\sellObjectAlbum','objectSellId','id');
    }

}
