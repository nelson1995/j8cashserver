<?php
namespace App\Http\Traits;

use Carbon\Carbon;

trait CurrentDateTimeTrait {

	public function getDateTime($country)
	{
		$time = "";
		$day="";
		$date ="";
		
		// if($country == "Tanzania"){
        //     $date = Carbon::now('Africa/Dar es Salaam');
        //     $day = $date->locale('en')->isoFormat('Do MM YYYY');
        // }

    	if($country == "Uganda"){
    		$date = Carbon::now('Africa/Kampala');
    		$day = $date->locale('en')->isoFormat('dddd Do MMMM YYYY');
    	}else if($country == "Kenya"){
            $date = Carbon::now('Africa/Nairobi');
            $day = $date->locale('en')->isoFormat('dddd Do MMMM YYYY');
        }else if($country == "Rwanda"){
            $date = Carbon::now('Africa/Kigali');
            $day = $date->locale('en')->isoFormat('dddd Do MMMM YYYY');
        }else if($country == "Drc"){
    		$date = Carbon::now('Africa/Kinshasa');
    		$day = $date->locale('fr')->isoFormat('dddd Do MMMM YYYY');
		}else if($country == "Zambia"){
			$date = Carbon::now('Africa/Lusaka');
			$day = $date->locale('en')->isoFormat('dddd Do MMMM YYYY');
		}

    	$time = Carbon::parse($date)->format('H:i:s');

		return $day . ', ' . $time;
		
   	}
}
