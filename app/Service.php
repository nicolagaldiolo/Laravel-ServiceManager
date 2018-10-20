<?php

namespace App;

use App\Enums\FrequencyRenewals;
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

    //appartiene ad un type
    public function serviceType(){
        return $this->belongsTo(ServiceType::class);
    }

    // Ha molti Renewals
    public function renewals(){
        return $this->hasMany(Renewal::class);
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
            ->whereDate('deadline', '<', Carbon::now()->startOfDay());
    }

    public function renewalsCurrent(){
        return $this->hasMany(Renewal::class)
            ->whereYear('deadline', Carbon::now()->year);
    }

    /*public function getTestAttribute()
    {
        return $this->renewals->sum('amount');
    }
    public function renewalsCount()
    {
        return $this->hasOne(Renewal::class)
            ->selectRaw('service_id, count(*) as count, sum(amount) as sum')
            ->groupBy('service_id');
    }

    public function getRenewalsCountAttribute()
    {
        // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('renewalsCount', $this->relations))
            $this->load('renewalsCount');

        $related = $this->getRelation('renewalsCount');

        // then return the count directly
        return ($related) ? collect(
            [
                'count' => $related->count,
                'sum' => $related->sum
            ]) : 0;
    }
    */


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
        $nextDeadline = null;
        if(!is_null($lastRenewal->deadline)){
            switch ($this->frequency) {
                case FrequencyRenewals::Weekly:
                    $nextDeadline = $lastRenewal->deadline->addWeek();
                    break;
                case FrequencyRenewals::Monthly:
                    $nextDeadline = $lastRenewal->deadline->addMonth();
                    break;
                case FrequencyRenewals::HalfYearly:
                    $nextDeadline = $lastRenewal->deadline->addMonths(6);
                    break;
                case FrequencyRenewals::Biennial:
                    $nextDeadline = $lastRenewal->deadline->addYears(2);
                    break;
                case FrequencyRenewals::Triennial:
                    $nextDeadline = $lastRenewal->deadline->addYears(3);
                    break;
                case FrequencyRenewals::Quadrennial:
                    $nextDeadline = $lastRenewal->deadline->addYears(4);
                    break;
                case FrequencyRenewals::Quinquennial:
                    $nextDeadline = $lastRenewal->deadline->addYears(5);
                    break;
                default:
                case FrequencyRenewals::Annual:
                    $nextDeadline = $lastRenewal->deadline->addYear();
                    break;
            }
        }

        return $nextDeadline;
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
