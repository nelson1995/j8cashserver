<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use DateTime;
use App\Transfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\TransferRepository;
use App\Http\Traits\CurrentDateTimeTrait;
use App\Http\Traits\ForexTrait;

class TransferController extends Controller
{
    use CurrentDateTimeTrait,ForexTrait;
    
    // web API methods
	protected $transfers;

    public function __construct(Transfer $transfers)
    {
        $this->transfers = new TransferRepository($transfers);
    }

    /*
     * display list of transfers made by users
     *
     * @return view
     * 
     * */
    public function index()
    {
        $transfers = Transfer::query()->with('sender','receiver')->get();        
        return view('layouts.transfers.index',[
            "user"=>Auth::user(),
            "transfers"=>$transfers
        ]);
    }

    public function send(Request $request)
    {
        $sender = $request->user();
        $sender->load('country');
    	//Decrement the balance of the user;
        $sender->wallet = $sender->wallet - $request->amount;

        // Increment the balance of the receiver;
        $receiver = User::findOrFail($request->receiver_id);
        $receiver->load('country');

        $converted_amount = $this->convertCurrency($sender->phone,$receiver->phone,$request->amount);


        $receiver->wallet = $receiver->wallet + $converted_amount;

        // Store the transfer;
        $transfer = new Transfer;
        $transfer->sender_id = $sender->id;
        $transfer->receiver_id = $receiver->id;
        $transfer->amount = $request->amount;
        $transfer->text = $request->text;
        $transfer->converted_amount = $converted_amount;
        $transfer->sender_date =  $this->getDateTime($sender->country[0]->country);
        $transfer->receiver_date =  $this->getDateTime($receiver->country[0]->country);
        $transfer->save();
        $sender->save();
        $receiver->save();

        return response()->json(['status'=>0, 'message'=>'Money transfer successful', 'wallet_balance'=>$sender->wallet]);
    }

    public function get_transfers()
    {
    	$user_id = Auth::id();
    	$transfers = Transfer::with('receiver')->where('sender_id', $user_id)->get();

    	return response()->json($transfers);
    }


    public function get_received()
    {
    	$user_id = Auth::id();
    	$transfers = Transfer::with('sender')->where('receiver_id', $user_id)->get();

    	return response()->json($transfers);
    }
}
