<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sales(){
        return $this->belongsTo(Sales::class);
    }
}
