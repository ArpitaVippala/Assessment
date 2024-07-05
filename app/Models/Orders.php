<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Orders extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['email', 'shipping_address_1'];

    public function orderItems(){
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }
}

