<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'phone', 'address',
        'country', 'city', 'zip_code', 'user_id',
        'status', 'total_price'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
