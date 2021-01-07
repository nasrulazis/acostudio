<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Orders;
use App\Products;

class Order_Details extends Model
{
    //
    protected $table='Order_Details';
    public function orders()
    {
        return $this->belongsTo(Orders::class,'orders_id');
    }
    public function products()
    {
        return $this->belongsTo(Products::class,'products_id');
    }
}
