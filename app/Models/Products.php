<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //table name
    protected $table = 'products';

    //primary key
    protected $primarykey = 'id';

    //timestamps
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_category_id');
        // $foreignKey = 'product_category_id';
        // return $this->belongsTo(ProductCategory::class, $foreignKey);
    }

    public function soldproduct()
    {
        return $this->hasMany('App\Models\SoldProduct');
    }
}
