<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }
}
