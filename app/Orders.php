<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order_Details;
use App\User;

class Orders extends Model
{
    //
    public function order_details()
    {
        return $this->hasMany(Order_Details::class,'orders_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
