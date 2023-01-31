<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentMethod;

class PaymentMethodController extends Controller
{
    // API METHODS

    public function get_payment_methods($country)
    {
    	$methods = PaymentMethod::where('country_id', $country)->get();
    	return response()->json($methods);
    	
    }
}
