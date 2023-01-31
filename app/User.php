<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens,Notifiable,HasMediaTrait,CanResetPassword;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username','email','phone' ,'password','invite_code','points','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function deposits()
    {
        return $this->hasMany('App\Deposit','user_id');
    }

    public function transfers()
    {
        return $this->hasMany('App\Transfer','sender_id');
    }

    public function airtime()
    {
        return $this->hasMany('App\Airtime','sender_id');
    }

    public function withdraws()
    {
        return $this->hasMany('App\WithDraw','user_id')->latest('date');
    }

    public function profilePicture()
    {
        return $this->getMedia("images")->last() === null ? "" : $this->getMedia("images")->last()->getFullUrl();
    }

    public function country()
    {
        return $this->belongsToMany('App\Country','country_users')
            ->using(CountryUser::class)
            ->withTimestamps();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
