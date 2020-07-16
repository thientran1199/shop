<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $primaryKey='id';
    protected $fillable=['categories_id','p_name','p_code','p_color','description','price','quantity','image'];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
