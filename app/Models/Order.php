<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_paid',
        'user_id',
        'payment_receipt'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->belongsTo(Transaction::class);
    }
}
