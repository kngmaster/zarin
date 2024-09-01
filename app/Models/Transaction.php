<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'user_id',
        'gateway_id',        
        'order_id',
        'bank_transaction_code',
        'bank_reference_code',
        'status',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function gateway(){
        return $this->hasOne(Gateway::class);
    }

}
