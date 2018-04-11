<?php

namespace VendingDroid\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function orderItems()
    {
        return $this->hasMany('VendingDroid\Models\OrderItem');
    }

}
