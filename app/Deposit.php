<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    //
    protected $fillable=['amount','phone','payment_method','tx_ref','date'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
