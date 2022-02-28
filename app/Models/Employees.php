<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    //table name
    protected $table = 'employees';

    //primary key
    protected $primarykey = 'id';

    //timestamps
    public $timestamps = true;

    public function store()
    {
        return $this->belongsTo('App\Models\Stores', 'storeID');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'managedBy');
    }

    public function owned()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function category()
    {
        return $this->hasMany('App\Models\ProductCategory');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sales');
    }
}
