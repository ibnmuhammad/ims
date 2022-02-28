<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    //table name
    protected $table = 'product_categories';

    //primary key
    protected $primarykey = 'id';

    //timestamps
    public $timestamps = true;

    public function employees()
    {
        return $this->belongsTo('App/Models/Employees', 'managedBy');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Products');
    }
}
