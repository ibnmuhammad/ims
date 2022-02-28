<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    //table name
    protected $table = 'sales';

    //primary key
    protected $primarykey = 'id';

    //timestamps
    public $timestamps = true;

    public function employee()
    {
        return $this->belongsTo('App\Models\Employees', 'seller');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Stores', 'store_id');
    }

    public function soldproduct()
    {
        return $this->hasMany('App\Models\SoldProduct');
    }
}
