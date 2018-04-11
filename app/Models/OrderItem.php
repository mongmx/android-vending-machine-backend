<?php

namespace VendingDroid\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    public function product()
    {
        return $this->belongsTo('VendingDroid\Models\Product');
    }

    public function order()
    {
        return $this->belongsTo('VendingDroid\Models\Order');
    }

}
