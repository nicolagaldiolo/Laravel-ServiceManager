<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Laravolt\Avatar\Facade as Avatar;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use File;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_verified', 'avatar', 'custom_avatar', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // ha molti domains
    public function domains()
    {
        return $this->hasMany(Domains::class);
    }

    // ha molti providers
    public function providers()
    {
        return $this->hasMany(Providers::class);
    }

    // ha molti socialAccount
    public function accounts(){
        return $this->hasMany(LinkedSocialAccount::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // mi torna la chiave primaria dell'utente, id
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isAdmin(){
        return $this->role == env('USER_ADMIN_ROLE');
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
                $path = $avatar->hashName('avatars');
            }
        }catch (\Exception $e){
            $path = 'avatars/' . uniqid() .".png";
        }

        $image = Image::make($avatar)->fit(200);
        Storage::put($path, (string) $image->encode());
        $this->attributes['avatar'] = $path;

    }

}
