<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccountStatements extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function  payment_type(){
        return $this->belongsTo(AccountStatementType::class,'account_statement_types_id','id');
    }
    public function  user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
