<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    protected $guarded = [];

    // appartiene ad un User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Ha molti Domini
    public function domains(){
        return $this->hasMany(Domains::class, 'domain', 'id', 'providers');
    }

    // Ha molti Hosting
    public function hostings(){
        return $this->hasMany(Domains::class, 'hosting', 'id', 'providers');
    }
}
