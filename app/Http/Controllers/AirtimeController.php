<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use App\Airtime;
use Auth;
use App\Http\Traits\CurrentDateTimeTrait;
use App\Repositories\AirtimeRepository;

class AirtimeController extends Controller
{
	use CurrentDateTimeTrait;

	// WEB API METHODS

	protected $airtime;

    public function __construct(Airtime $airtime)
    {
        $this->airtime = new AirtimeRepository($airtime);
    }

	/*
	* return all airtimes bought by users	
	* @return view
	*/
	public function index()
	{
		$airtimes = Airtime::query()->with('users')->get();
		return view('layouts.airtime.index',[
			"user"=> Auth::user(),
			"airtimes"=>$airtimes
		]);
	}



	// USER API METHODS
    public function buy(Request $request){

		$user = $request->user();
		$user->load('country');

    	// Set your app credentials
		$username = "sandbox";
		$apiKey   = config('services.africastalking.key');


		// Initialize the SDK
		$AT       = new AfricasTalking($username, $apiKey);

		//Get the airtime service
		$airtime  = $AT->airtime();

		// Set the phone number, currency code and amount
		$recipients = [[
		    "phoneNumber"  => $request->phone,
		    "currencyCode" => $request->currency,
		    "amount"       => $request->amount
		]];

		// That's it, hit send and we'll take care of the rest
		try {
		    $result = $airtime->send([
		        "recipients" => $recipients
		    ]);

		    if($result['status'] == "success"){
		    	$model = new Airtime;
			    $model->sender_id = $user->id;
			    $model->amount = $request->amount;
			    $model->phone = $request->phone;
			    $model->currency = $request->currency;
			    $model->amountString = $result['data']->totalAmount; //$results['data']['totalAmount'];
			   	$model->discountString = $result['data']->totalDiscount;
			   	$model->date = $this->getDateTime($user->country[0]->country);
			   	$responses = $result['data']->responses;
			   	if(count($responses) != 0 ){
			   		$model->requestId = $responses[0]->requestId;
					$model->status = $responses[0]->status;
					$user->wallet = $user->wallet - $request->amount;
					$model->wallet_balance = $user->wallet;
    				$user->save();
    				$model->save();

  					$response = [
						'code' => 1,
						'status' => $responses[0]->status,
						'data' => $model
		    		];
			   	}else{
			   		$response = [
						'code' => 0,
		                'status' => "A duplicate request was received within the last 5 minutes"
		    		];

			   	}

			   	//$response = $result;
			 
		    }
		  
		} catch(\Exception $e) {
			$response = [
				'code' => 0,
                'status' => $e->getMessage()
    		];
		}

		return response()->json($response);
	}

	public function get_airtime_list(){
		$list = Airtime::where('sender_id', Auth::id())->get();

		return response()->json($list);
	}
}
