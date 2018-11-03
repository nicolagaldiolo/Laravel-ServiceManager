<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Provider extends Model
{
    protected $guarded = [];

    // appartiene ad un User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Ha molti services
    public function services(){
        return $this->hasMany(Service::class);
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
