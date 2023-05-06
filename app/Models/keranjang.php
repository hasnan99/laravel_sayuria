<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    use HasFactory;
    protected $table = "keranjang";
    protected $fillable = [
        'user_id',
        'sayur_id',
        'quantity',
    ];

    public function item_sayur(){
        return $this->belongsTo(sayurmodel::class,'sayur_id','id');
    }
    public function item_user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
