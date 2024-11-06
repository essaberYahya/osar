<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectCategory extends Model
{
    use HasFactory;

    //protected $with = ["projectCount"];

    protected $fillable = ["name", "icon", "description", "color"];

    public function projectCount()
    {
        return $this->hasMany("\App\Models\project", "category_id", "id");
    }

    public function sellsObject()
    {
        return $this->hasMany('\App\Models\sellObject', 'category_id', 'id');
    }
}
