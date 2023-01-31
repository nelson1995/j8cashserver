<?php
/* 
    Author: Nelson G.k
    date: 19/08/2020
*/
namespace App\Http\Traits;

use App\Country;
use App\ExchangeRate;
use App\User;


trait ForexTrait {

    public function convertCurrency($sender_mobile,$receiver_mobile,$amount)
    {
        $user = User::query()->where('phone',$sender_mobile)->first();
        $user->load('country');
        $from_currency = $user->country[0]->currency;
        $receivers_phone_code = substr($receiver_mobile,0,3-strlen($receiver_mobile));

        $receivers_country = Country::query()->where('phone_code',$receivers_phone_code)->first();

        $to_currency = $receivers_country->currency;
        
        if($from_currency === $to_currency)
        {
            return $amount;
        }

        $forex_rate = ExchangeRate::query()->where('from_currency',$from_currency)
                                            ->where('to_currency',$to_currency)
                                            ->first();
        
        return floatval($amount)*floatval($forex_rate->rate);
    }

}