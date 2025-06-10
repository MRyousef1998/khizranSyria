<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{ 
     
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
   
    protected $dates = ['deleted_at'];

  public function  order(){
        return $this->belongsToMany(Order::class,'order_product','products_id','orders_id');
    }
    public function  productsDetaile(){
        return $this->belongsTo(ProductDetail::class,'product_details_id','id');
    }

        public function order_product(): MorphToMany
    {
        return $this->morphToMany(Order::class, 'order_product');
    }
   
    
}
