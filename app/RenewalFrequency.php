<?php

namespace App;

use App\Enums\RenewalFrequencies;
use Illuminate\Database\Eloquent\Model;

class RenewalFrequency extends Model
{
    protected $guarded = [];

    // appartiene ad un User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Ha molti Services
    public function services(){
        return $this->hasMany(Service::class);
    }

    public function getFrequencyAttribute()
    {
        return $this->value . " " . RenewalFrequencies::getDescription($this->type);
    }
}
