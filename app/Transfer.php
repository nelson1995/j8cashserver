<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = ['amount','sender_date','receiver_date','text','converted_amount'];

    public function sender()
    {
    	return $this->belongsTo('App\User', 'sender_id');
    }

	public function receiver()
    {
    	return $this->belongsTo('App\User', 'receiver_id');
    }

}
