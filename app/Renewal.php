<?php

namespace App;

use App\Http\Traits\StatableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Renewal extends Model
{
    use StatableTrait;

    const SM_CONFIG = 'renewal'; // the SM graph to use
    const HISTORY_MODEL = [
        'name' => RenewalState::class // the related model to store the history
    ];

    protected $dates = [
        'deadline'
    ];

    protected $guarded = [];

    // appartiene ad un Service
    public function service(){
        return $this->belongsTo(Service::class);
    }

    //mi faccio tornare l'utente a cui appartiene indirettamente questo renewal
    public function user(){
        return $this->service->customer->user;
    }

    public function getDeadlineFormattedAttribute()
    {
        return is_null($this->deadline) ? $this->deadline : $this->deadline->format('d-m-Y');
    }

    public function getDeadlineVerboseAttribute()
    {
        return is_null($this->deadline) ? $this->deadline : $this->deadline->format('j F Y');

    }

    public function setDeadlineAttribute($deadline) {
        if(is_string($deadline)) $deadline = Carbon::createFromFormat('d-m-Y', $deadline);
        $this->attributes['deadline'] = $deadline;
    }

    public function getAmountFormattedAttribute()
    {
        return is_null($this->amount) ? $this->amount : number_format($this->amount, 2, ',', '.');
    }

    public function getAmountVerboseAttribute()
    {
        return is_null($this->amount) ? $this->amount : '&euro; ' . number_format($this->amount, 2, ',', '.');
    }

    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = $this->floatvalue($amount);
    }

    public function floatvalue($val){
        $val = str_replace(",",".",$val);
        $val = preg_replace('/\.(?=.*\.)/', '', $val);
        return floatval($val);
    }

    //public function scopeCurrentDeadline($query){
    //    return $query->whereDate('deadline', '>=', Carbon::now())->first();
    //}



}
