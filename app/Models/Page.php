<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = "pages";

    protected $fillable = [
        'name',
        'url',
        'status',        
    ];    

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
