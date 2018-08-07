<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;
use Laravolt\Avatar\Facade as Avatar;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

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
        return ($avatar) ? '/storage/avatar/' . $avatar : '';
    }



    public function setAvatarAttribute($avatar)
    {
        //Se volessi settare un custom name per il file
        //  $fileName = "avatar_" . $this->id . '.' . $avatar->extension();
        //  $this->attributes['avatar'] = $avatar->storeAs('avatar', $fileName);
        //dd($avatar);
        //$old_file =

            try{
                unlink(public_path() . '/storage/avatar/' . $this->attributes['avatar']);
            }catch (\Exception $e){

            }


        //if (Storage::exists($file)) {
        //
        //}

        $image = \Intervention\Image\Facades\Image::make($avatar);
        //$path = $avatar->hashName('avatar');
        $image->fit(200);

        $hashed_random_password = Hash::make(str_random(4));
        //$filename = time() . '.' . $avatar->getClientOriginalExtension();
        //Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );

        $filename = uniqid() . ".png";
        $image->save(public_path() . '/storage/avatar/' . $filename);
        $this->attributes['avatar'] = $filename;


        //$this->attributes['avatar'] = $avatar->fit(100,100)->storeAs('avatar', $this->id . '.png');
        //$this->attributes['avatar'] = $avatar->store('avatar');

    }

}
