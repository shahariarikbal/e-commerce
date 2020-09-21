<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function sub_category(){
        return $this->hasMany(SubCategory::class, 'main_category_id', 'id');
    }

    public function product(){
        return $this->hasMany('App\Product');
    }

    public function features(){
        return $this->hasMany(Featured::class, 'main_category_id', 'id');
    }

    public function customer()
    {
        return $this->hasMany('App\CustomerProduct');
    }

    public function orderProduct(){
        return $this->hasMany('App\OrderProduct');
    }
}
