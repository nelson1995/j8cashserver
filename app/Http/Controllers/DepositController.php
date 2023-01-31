<?php

namespace App\Http\Controllers;
/* 
    Author:Nelson K
*/
use Auth;
use App\User;
use App\Deposit;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Traits\CurrentDateTimeTrait;
use App\Repositories\DepositRepository;

class DepositController extends Controller
{
    use CurrentDateTimeTrait;
    
    // web API methods
	protected $deposit;

    public function __construct(Deposit $deposit)
    {
        $this->deposit = new DepositRepository($deposit);
    }

    /*
     * display all user's deposits
     *
     * @return view
     * */
    public function index()
    {   
        $deposits = Deposit::query()->with('user')->get();
        return view('layouts.deposits.index',[
            "user"=>Auth::user(),
            "deposits"=>$deposits]);
    }

    // API METHODS
    public function make_deposit(Request $request)
    {
        $request->validate([
            'payment_method'=>'required',
            'amount'=>'required',
            'phone'=>'required',
            'tx_ref'=>'required'
        ]);
        // $user = Auth::user();
        $user = $request->user();
        $user->load('country');

        // Save new deposit
    	$deposit =  new Deposit;
    	$deposit->user_id = $user->id;
    	$deposit->phone = $request->phone;
    	$deposit->amount = $request->amount;
    	$deposit->payment_method = $request->payment_method;
        $deposit->tx_ref = $request->tx_ref;
    	// Get Date

    	$deposit->date =  $this->getDateTime($user->country[0]->country);

		// Update user's account balance
    	$user->wallet = $user->wallet + $request->amount;
    	$user->save();
        $deposit->wallet_balance = $user->wallet;
        $deposit->save();

    	return response()->json($deposit);
    }

    // public function callback(Request $request)
    // {
    //     $data = json_decode($request->getContent(), true);
    //     $txref = $request->transfer['reference'];
    //     $deposit = Deposit::query()->where('tx_ref',$txref)->first();
    //     $user = User::query()->where('id',$deposit->user_id)->first();
    //     if($deposit){
    //         $deposit->status = $request->transfer['status'];
    //         $deposit->message = $request->transfer['complete_message'];
    //         if($request->transfer['status'] === "SUCCESSFUL"){
    //             $user->wallet = $user->wallet + $request->amount;
    //             $user->save();
    //             $deposit->wallet_balance = $user->wallet;
    //         }
    //         else{
    //             $deposit->wallet_balance = $user->wallet;
    //         }
    //         $deposit->save();
    //     }
    // }

    public function get_deposits()
    {
    	$user = Auth::user();
    	return response()->json($user->deposits);
    }
}
