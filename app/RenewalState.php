<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenewalState extends Model
{
    protected $guarded = [];

    public function renewal(){
        return $this->belongsTo(Renewal::class);
    }
}
