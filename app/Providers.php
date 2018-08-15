<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Providers extends Model
{
    protected $guarded = [];

    // appartiene ad un User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Ha molti Domini
    public function domains(){
        return $this->hasMany(Domains::class, 'domain_id', 'id', 'providers');
    }

    // Ha molti Hosting
    public function hostings(){
        return $this->hasMany(Domains::class, 'hosting_id', 'id', 'providers');
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
