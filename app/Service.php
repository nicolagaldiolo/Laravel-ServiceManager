<?php

namespace App;

use App\Enums\FrequencyRenewals;
use App\Enums\RenewalFrequencies;
use App\Enums\RenewalSM;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use File;

class Service extends Model
{

    protected $guarded = [];

    //appartiene ad un customer
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    //appartiene ad un provider
    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    //appartiene ad un serviceType
    public function serviceType(){
        return $this->belongsTo(ServiceType::class);
    }

    //appartiene ad un type
    public function renewalFrequency(){
        return $this->belongsTo(RenewalFrequency::class);
    }

    // Ha molti Renewals
    public function renewals(){
        return $this->hasMany(Renewal::class);
    }

    // Ha molti ActiveRenewals
    public function activeRenewals(){
        return $this->hasMany(Renewal::class)
            ->where('status', '<>', RenewalSM::S_suspended);
    }

    // Ha un NextRenewal
    public function nextRenewal(){
        return $this->hasOne(Renewal::class)
            ->whereDate('deadline', '>=', Carbon::now()->startOfDay())
            ->orderBy('deadline', 'ASC');
    }

    // Ha molti RenewalsUnresolved
    public function renewalsUnresolved(){
        return $this->hasMany(Renewal::class)
            ->where('status', '<', RenewalSM::S_payed)
            ->whereDate('deadline', '<=', Carbon::now()->endOfMonth());
    }

    // Ha molti RenewalsExpiring
    public function renewalsExpiring(){
        return $this->hasMany(Renewal::class)
            ->where('status', RenewalSM::S_to_confirm)
            ->whereDate('deadline', '<=', Carbon::now()->addMonth()->endOfMonth())
            ->orderBy('deadline');
    }

    public function renewalsCurrent(){
        return $this->hasMany(Renewal::class)
            ->whereYear('deadline', Carbon::now()->year);
    }

    //mi faccio tornare l'utente a cui appartiene indirettamente questo service
    public function user(){
        return $this->customer->user;
    }

    public function lastRenewalInsert(){
        return $this->renewals()->orderBy('deadline', 'DESC')->firstOrNew([]);
    }

    public function calcNextDeadline()
    {
        $lastRenewal = $this->lastRenewalInsert();
        $renewalFrequency = $this->renewalFrequency;

        $nextDeadline = null;

        if(!is_null($lastRenewal->deadline) && !is_null($renewalFrequency)){
            switch ($renewalFrequency->type) {
                case RenewalFrequencies::Days:
                    $nextDeadline = $lastRenewal->deadline->addDays($renewalFrequency->value);
                    break;
                case RenewalFrequencies::Weeks:
                    $nextDeadline = $lastRenewal->deadline->addWeeks($renewalFrequency->value);
                    break;
                case RenewalFrequencies::Months:
                    $nextDeadline = $lastRenewal->deadline->addMonths($renewalFrequency->value);
                    break;
                case RenewalFrequencies::Years:
                    $nextDeadline = $lastRenewal->deadline->addYears($renewalFrequency->value);
                    break;
            }
        }

        return $nextDeadline;
    }

    public function getScreenshootAttribute($screenshoot)
    {
        return ($screenshoot) ?
            '/storage/' . config('custompath.users') . '/' . $this->user()->id . '/' . config('custompath.services') . '/' .  $screenshoot :
            asset('images/default.png');
    }

    public function setScreenshootAttribute($screenshoot)
    {
        if(File::exists(public_path($this->screenshoot))) File::delete(public_path($this->screenshoot)); // elimino il vecchio file se esiste

        $this->attributes['screenshoot'] = $screenshoot;
    }

}
