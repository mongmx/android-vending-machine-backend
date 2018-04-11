<?php

namespace VendingDroid\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function products()
    {
        return $this->hasMany('VendingDroid\Models\Product');
    }

}
