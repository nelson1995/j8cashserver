<?php

namespace Database\Seeders;

use App\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = new Country();
        $country->country = "Rwanda";
        $country->country_code = "RW";
        $country->phone_code = "250";
        $country->currency = "RWF";
        $country->save();

        $country1 = new Country();
        $country1->country = "Kenya";
        $country1->country_code = "KE";
        $country1->phone_code = "254";
        $country1->currency = "KES";
        $country1->save();

        // $country2 = new Country();
        // $country2->country = "Tanzania";
        // $country2->country_code = "TZ";
        // $country2->phone_code = "255";
        // $country2->currency = "TZS";
        // $country2->save();

        $country3 = new Country();
        $country3->country = "Uganda";
        $country3->country_code = "UG";
        $country3->phone_code = "256";
        $country3->currency = "UGX";
        $country3->save();

        $country4 = new Country();
        $country4->country = "Zambia";
        $country4->country_code = "zm";
        $country4->phone_code = "260";
        $country4->currency = "ZMW";
        $country4->save();
    }
}
