<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Status;
use App\Models\OrderCategory;


use LengthException;

class Order extends Model
{

    use HasFactory;
    protected $guarded=[];
    public function  product(){
        return $this->belongsToMany(Product::class,'order_product','orders_id','products_id');
    }
    public function  category(){
        return $this->belongsTo(OrderCategory::class,'category_id','id');
       
    }
    public function  importer(){
        return $this->belongsTo(User::class,'exported_id');
    }
    public function  representative(){
        return $this->belongsTo(User::class,'representative_id');
    }
    public function  countAllItem():int{
        $count= $this->belongsToMany(Product::class,'order_product','orders_id','products_id');
        return $count->count();
    }
    public function  countMachine(){
        $productes= $this->belongsToMany(Product::class,'order_product','orders_id','products_id');
        
      return $productes;
    
    }
    
    public function  status(){
        return  $this->belongsTo(Status::class,'statuses_id','id');
        
    }
    


    
}
