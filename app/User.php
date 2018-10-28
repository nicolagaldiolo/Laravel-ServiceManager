<?php

namespace App;

use App\Enums\UserType;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use File;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_verified', 'avatar', 'custom_avatar', 'role', 'lang'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // ha molti customers
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    // ha molti services attraverso i customers
    public function services()
    {
        return $this->hasManyThrough(Service::class, Customer::class);
    }

    // ha molti providers
    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    // ha molti types
    public function serviceTypes()
    {
        return $this->hasMany(ServiceType::class);
    }

    // ha molti renewalFrequencies
    public function renewalFrequencies()
    {
        return $this->hasMany(RenewalFrequency::class)
            ->orderBy('type')->orderBy('value');
    }

    // ha molti socialAccount
    public function accounts(){
        return $this->hasMany(LinkedSocialAccount::class);
    }

    public function isAdmin(){
        return $this->role == UserType::Admin;
    }


    public function getAvatarAttribute($avatar)
    {
        return ($avatar) ? '/storage/' . $avatar : '';
    }


    public function setAvatarAttribute($avatar)
    {

        if(File::exists(public_path($this->avatar))) File::delete(public_path($this->avatar)); // elimino il vecchio file se esiste

        try{ // il metodo hashName è un metodo dell'oggetto UploadedFile, quindi quando non ce l'ho disponibile genero il path a mano
            if(is_string($avatar)){
                throw new \Exception('Avatar is a string');
            }else{
                $path = $avatar->hashName(config('custompath.avatars'));
            }
        }catch (\Exception $e){
            $path = config('custompath.avatars') . '/' . uniqid() .".png";
        }

        $image = Image::make($avatar)->fit(200);
        Storage::put($path, (string) $image->encode());
        $this->attributes['avatar'] = $path;

    }

    public function scopeAdmin($query)
    {
        return $query->where('role', UserType::Admin);
    }

    public function scopeServicesExpiring($query)
    {
        return $query->whereHas('customers.services.renewalsUnresolved')->with(
            [
                'customers' => function ($q) {
                    $q->whereHas('services.renewalsUnresolved');
                },
                'customers.services' => function ($q) {
                    $q->whereHas('renewalsUnresolved')->with('provider', 'serviceType', 'renewalsUnresolved');
                }
            ]);
    }

}
