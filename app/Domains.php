<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

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
        return $this->belongsTo(Providers::class, 'domain_id', 'id', 'providers');
    }

    // appartiene a un Providers(hosting)
    public function hosting(){
        return $this->belongsTo(Providers::class, 'hosting_id', 'id', 'providers');
    }

    public function getScreenshootAttribute($screenshoot)
    {
        return ($screenshoot) ? '/storage/' . $screenshoot : '';
    }

    public function setScreenshootAttribute($screenshoot)
    {
        if(File::exists(public_path($this->screenshoot))) File::delete(public_path($this->screenshoot)); // elimino il vecchio file se esiste

        $this->attributes['screenshoot'] = $screenshoot;
    }

}
