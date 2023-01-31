<?php

use Illuminate\Database\Seeder;
use App\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$method1 = new PaymentMethod;
    	$method1->name = 'MTN Mobile Money';
    	$method1->code = 'mtn_ug';
    	$method1->id = 1;
    	$method1->country_id = 1;
    	$method1->save();

    	$method2 = new PaymentMethod;
    	$method2->name = 'Airtel Money';
    	$method2->code = 'airtel_ug';
    	$method2->id = 2;
    	$method2->country_id = 1;
    	$method2->save();

    	$method3 = new PaymentMethod;
    	$method3->name = 'Card Payment';
    	$method3->code = 'card';
    	$method3->id = 3;
    	$method3->country_id = 1;
    	$method3->save();
    }
}
