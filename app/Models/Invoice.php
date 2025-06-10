<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function  category(){
        return $this->belongsTo(InvoiceCategory::class,'invoice_categories_id','id');
    }
    public function  order(){
        return $this->belongsTo(Order::class,'orders_id','id');
    }
}
