<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airtime extends Model
{
    //
    protected $fillable=['phone','amount','amountString','discountString','currency','requestId','status'];

    public function users()
    {
        return $this->belongsTo('App\User','sender_id');
    }
}
