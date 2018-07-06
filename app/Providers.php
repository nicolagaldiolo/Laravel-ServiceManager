<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{

    // appartiene ad un User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Ha molti Domini
    public function domainsDomain(){
        return $this->hasMany(Domains::class, 'domain', 'id', 'providers');
    }

    // Ha molti Hosting
    public function domainshosting(){
        return $this->hasMany(Domains::class, 'hosting', 'id', 'providers');
    }
}
