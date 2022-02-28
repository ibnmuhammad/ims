<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoldProduct extends Model
{
    //table name
    protected $table = 'sold_products';

    //primary key
    protected $primarykey = 'id';

    //timestamps
    public $timestamps = true;

    public function sales()
    {
        return $this->belongsTo('App\Models\Sales', 'sales_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Products', 'product_id');
    }
}
