<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function sales_details(){
        return $this->hasMany(SalesDetail::class,'sales_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'cust_id');
    }
}
