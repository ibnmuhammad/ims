<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    //table name
    protected $table = 'stores';

    //primary key
    protected $primarykey = 'id';

    //timestamps
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function employee()
    {
        return $this->hasMany('App\Models\Employees');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sales');
    }
}
