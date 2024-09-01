<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'name',
        'url',        
        'callback_url',
        'startpay_url',
        'terminal',
        'api_key',
        'password',
        'status',
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
  

}
