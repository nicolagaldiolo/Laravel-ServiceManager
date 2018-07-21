<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{

    protected $guarded = [];

    protected $dates = [
        'deadline'
    ];

    // appartiene ad un User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // appartiene a un Providers(domain)
    public function domain(){
        return $this->belongsTo(Providers::class, 'domain', 'id', 'providers');
    }

    // appartiene a un Providers(hosting)
    public function hosting(){
        return $this->belongsTo(Providers::class, 'hosting', 'id', 'providers');
    }

}
