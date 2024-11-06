<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    protected $with = ["category","album"];

    /**$table->text("title");
            $table->text("description");
            $table->integer("category_id");
            $table->text("cover");
            $table->text("htmlPart");
            $table->boolean("hidden")->default(0); */
    protected $fillable = ["title","description","category_id","cover","htmlPart","hidden"];

    public function category(){
        return $this->belongsTo("\App\Models\projectCategory",'category_id','id');
    }

    public function album(){
        return $this->hasMany("\App\Models\projectAlbum","project_id","id");
    }
}
