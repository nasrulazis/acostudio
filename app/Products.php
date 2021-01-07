<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Order_Details;

class Products extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function order_details()
    {
        return $this->hasOne(Order_Details::class,'products_id');
    }
}
