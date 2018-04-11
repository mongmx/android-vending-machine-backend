<?php

namespace VendingDroid\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{

    use SoftDeletes;
    use SearchableTrait;

    protected $dates = ['deleted_at'];

    protected $searchable = [
        'columns' => [
            'products.name' => 3,
            'products.name_en' => 3,
        ],
        //'joins' => [
        //]
    ];

    public function category()
    {
        return $this->belongsTo('VendingDroid\Models\Category');
    }

    public function orderItem()
    {
        return $this->hasMany('VendingDroid\Models\OrderItem');
    }

}
