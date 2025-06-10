<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectOrder 
{

   public int $product_id; 
   public int $price;  

   public int $commission_pice;  
   public int $qtr;  

    public function __construct($product_id ,$price,$commission_pice,$qtr){
        
    $this->product_id=$product_id;
    $this->price=$price;

    $this->commission_pice=$commission_pice;

    
        $this->qty=$qtr;
    
    }

}
