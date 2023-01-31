<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithDraw extends Model
{
    //
    protected $fillable = ['amount','wallet_balance','date'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
