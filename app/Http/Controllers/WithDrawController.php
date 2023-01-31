<?php

namespace App\Http\Controllers;
/* 
    Author:Nelson K
*/

use App\Http\Traits\CurrentDateTimeTrait;
use App\Repositories\WithDrawRepository;
use Illuminate\Http\Request;
use App\WithDraw;
use App\User;
use Auth;

class WithDrawController extends Controller
{
    use CurrentDateTimeTrait;

    // web API methods
	protected $withDraw;

    public function __construct(WithDraw $withDraw)
    {
        $this->withDraw = new WithDrawRepository($withDraw);
    }

    /* 
        api withdraws from user's wallet
    */
    public function withDraw(Request $request)
    {
        $request->validate([
            'amount'=>'required',
            'phone'=>'required',
            'tx_ref'=>'required'
        ]);

        $user = $request->user();
        $withDraw = WithDraw::query()->where('user_id',$user->id)->latest('updated_at')->first();
        if($request->amount > $user->wallet){
            $response = [
                'code' => 0,
                'status' => "You don't have enough money in your wallet",
                'data' => [
                    "amount_requested"=>$request->amount,
                    "wallet_balance"=>$user->wallet
                ]
            ];
            return response()->json($response);
        }

        $user->load('country');
        $withdraw = new WithDraw;
        $withdraw->amount = $request->amount;
        $withdraw->tx_ref = $request->tx_ref;
        $withdraw->phone = $request->phone;
        $withdraw->user_id = $user->id;
        $withdraw->date = $this->getDateTime($user->country[0]->country);
        $withdraw->status = "PROCESSING";
        // update user's wallet balance
        $withdraw->save();
        
        return response()->json($withdraw);
    }

    public function callback(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $txref = $request->transfer['reference'];
        $withdraw = WithDraw::where('tx_ref',$txref)->first();
        $user = User::query()->where('id',$withdraw->user_id)->first();
        if($withdraw){
            $withdraw->status = $request->transfer['status'];
            $withdraw->message = $request->transfer['complete_message'];
            if($request->transfer['status'] === "SUCCESSFUL"){
                $user->wallet = $user->wallet - $request->amount - $request->fees;
                $user->save();
                $withdraw->wallet_balance = $user->wallet;
            }
            else{
                $withdraw->wallet_balance = $user->wallet;
            }
            $withdraw->save();
        }
    }

    
    /* 
        api get users withdraws
    */
    public function getWithDraws(Request $request)
    {
        return response()->json($request->user()->withdraws);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdraws = Withdraw::query()->with('user')->get();
        return view('layouts.withdraws.index',[
            'user'=>Auth::user(),
            'withdraws'=>$withdraws
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
