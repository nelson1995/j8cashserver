<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\Http\Traits\CurrentDateTimeTrait;
use App\Repositories\ExchangeRateRepository;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;

class ExchangeRateController extends Controller
{
    use CurrentDateTimeTrait;

    protected $exchangeRate;

    public function __construct(ExchangeRate $exchangeRate)
    {
        $this->exchangeRate = new ExchangeRateRepository($exchangeRate);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.settings.exchangerates.index',[
            "user"=>Auth::user(),
            "exchangeRates"=> $this->exchangeRate->all()
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
        return view('layouts.settings.exchangerates.create',["user"=>Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'from_country'=>'required',
            'from_currency'=>'required',
            'to_currency'=>'required',
            'to_country'=>'required',
            'rate'=>'required|numeric',
        ]);

        $result = $this->exchangeRate
        ->create($request->only($this->exchangeRate->getExchangeRate()->fillable));

        if(!$result){
            return Redirect::back()->withErrors("An error occured while creating record");
        }
        return redirect()->route('exchange_rates');
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
        $showExchangeRate = $this->exchangeRate->show($id);
        
        return view('layouts.settings.exchangerates.edit',[
            "user"=>Auth::user(),
            "exchangeRates"=>$showExchangeRate
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'from_country'=>'required',
            'from_currency'=>'required',
            'to_currency'=>'required',
            'to_country'=>'required',
            'rate'=>'required|numeric',
        ]);

        $result = $this->exchangeRate->update($request->only($this->exchangeRate->getExchangeRate()->fillable),$request->id);
        
        if(!$result){
            return Redirect::back()->withErrors("An error occured while updating record");
        }

        return redirect()->route('exchange_rates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exchangeRate = $this->exchangeRate->delete($id);
        if(!$exchangeRate)
        {
            return Redirect::back()->withErrors("Failed to delete record");
        }
        return redirect()->route('exchange_rates');
    }

}
