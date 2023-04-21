<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';

    protected $fillable = ['name','created_by','category_id'];

    public function category(){
        return $this->belongsTo('App\Model\Category');
    }
}
