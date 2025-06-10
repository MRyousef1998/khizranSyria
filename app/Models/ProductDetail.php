<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCompany;
use App\Models\ProductGroup;
use App\Models\ProductCategory;




class ProductDetail extends Model
{
    use HasFactory;
    
    protected $guarded=[];


    public function companies()
    {
    return $this->belongsTo(ProductCompany::class,'company_id');
   
    }
    public function  groups(){
        return $this->belongsTo(ProductGroup::class,'group_id',);
    }
    public function  category(){
        return $this->belongsTo(ProductCategory::class,'category_id');
    }
}
