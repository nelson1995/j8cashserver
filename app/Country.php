<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['country','country_code','phone_code','currency'];

    public function users()
    {
        return $this->belongsToMany('App\User','country_users')
            ->using(CountryUser::class)
            ->withTimestamps();
    }
}
