<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function  boxes(){
        return $this->hasMany(Box::class, 'shipment_id', 'id');
    }
    public function  importer(){
        return $this->belongsTo(User::class,'client_id');
    }
}
