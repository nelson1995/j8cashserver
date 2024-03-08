<?php

namespace Database\Seeders;

use App\User;
use App\Deposit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Http\Traits\CurrentDateTimeTrait;
use Illuminate\Database\Eloquent\Builder;

class DepositsTableSeeder extends Seeder
{
    use CurrentDateTimeTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roleName='user';
        $users = User::query()->whereHas('roles',
            function(Builder $query) use ($roleName){
                $query->where('name','=',$roleName);
            }
        )->get();
        for($i=0;$i<10;$i++){
            $randomUser = $users[rand(0,3)];
            $deposit = new Deposit;
            $deposit->user_id = $randomUser->id;
            $deposit->phone = $randomUser->phone;
            $deposit->amount = 3000;
            $deposit->payment_method = "Deposit money in account";
            $deposit->date = $this->getDateTime("Uganda");
            $deposit->wallet_balance = $randomUser->wallet + $deposit->amount;
            $randomUser->wallet = $deposit->wallet_balance;
            $deposit->save();
            $randomUser->save();
        }
    }
}
