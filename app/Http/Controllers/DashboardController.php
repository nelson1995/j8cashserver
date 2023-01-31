<?php

namespace App\Http\Controllers;

use App\User;
use App\Chart;
use App\Airtime;
use App\Deposit;
use App\Transfer;
use App\WithDraw;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AirtimeRepository;
use App\Repositories\DepositRepository;
use App\Repositories\TransferRepository;
use App\Repositories\WithDrawRepository;

class DashboardController extends Controller
{
    protected $user;
    protected $deposit;
    protected $withDraw;
    protected $transfer;
    protected $airtime;

    public function __construct(User $user,Airtime $airtime,Transfer $transfer,WithDraw $withDraw, Deposit $deposit)
    {
        $this->user = new UserRepository($user); 
        $this->deposit = new DepositRepository($deposit); 
        $this->withDraw = new WithDrawRepository($withDraw); 
        $this->transfer = new TransferRepository($transfer); 
        $this->airtime = new AirtimeRepository($airtime); 
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $user = Auth::user();
    
        return view('layouts.dashboard')->with(compact("user"));
    }

    public function charts()
    {
        $registeredUsersPerMonth = $this->user->registeredUsersPerMonth();
        $registeredUsers = [0,0,0,0,0,0,0,0,0,0,0,0]; //init months to zero
        foreach($registeredUsersPerMonth as $key){
            $registeredUsers[$key->month-1] = $key->total;
        }

        $totalUsers = $this->user->totalUsersPerCountry();
        $registeredUsersPerCountry = [];
        foreach($totalUsers as $key){
            $registeredUsersPerCountry[$key->country] = $key->users_count;
        }

        $airtimeTransactions = $this->airtime->sumOfAirtimeTransactions();
        $airtimeMonthlyTransactions = [0,0,0,0,0,0,0,0,0,0,0,0]; //init months to zero
        foreach($airtimeTransactions as $key){
            $airtimeMonthlyTransactions[$key->month-1] = $key->total;
        }

        $transfers = $this->transfer->monthlyTransfers();     
        $monthlyTransfers = [0,0,0,0,0,0,0,0,0,0,0,0]; //init months to zero
        foreach($transfers as $key){
            $monthlyTransfers[$key->month-1] = $key->total;
        }

        $withDraws = $this->withDraw->monthlyWithDraws();     
        $monthlyWithDraws = [0,0,0,0,0,0,0,0,0,0,0,0]; //init months to zero
        foreach($withDraws as $key){
            $monthlyWithDraws[$key->month-1] = $key->total;
        }

        $deposits = $this->deposit->monthlyDeposits();     
        $monthlyDeposits = [0,0,0,0,0,0,0,0,0,0,0,0]; //init months to zero
        foreach($deposits as $key){
            $monthlyDeposits[$key->month-1] = $key->total;
        }

        return response()->json([
            'registeredUsers' => $registeredUsers,
            'registeredUsersPerCountry' => $registeredUsersPerCountry,
            'airtimeMonthlyTransactions' => $airtimeMonthlyTransactions,
            'monthlyTransfers' => $monthlyTransfers,
            'monthlyDeposits' => $monthlyDeposits,
            'monthlyWithDraws' => $monthlyWithDraws
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
