<?php

use App\User;
use App\Airtime;
use Illuminate\Database\Seeder;
use App\Http\Traits\CurrentDateTimeTrait;
use Illuminate\Database\Eloquent\Builder;

class AirtimeTableSeeder extends Seeder
{
    use CurrentDateTimeTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleName='user';
        $users = User::query()->whereHas('roles',
            function(Builder $query) use ($roleName){
                $query->where('name','=',$roleName);
            }
        )->get();
        for($i=0;$i<10;$i++){
            $randomUser = $users[rand(0,3)];
            $airtime = new Airtime;
            $airtime->sender_id = $randomUser->id;
            $airtime->phone = $randomUser->phone;
            $airtime->amount = 1000;
            $airtime->amountString = "1000";
            $airtime->discountString = "1000";
            $airtime->currency = "UGX";
            $airtime->requestId = "1234567890";
            $airtime->status = "SUCCESSFUL";
            $airtime->date = $this->getDateTime("Uganda");
            $randomUser->wallet = $randomUser->wallet-$airtime->amount;
            $airtime->wallet_balance = $randomUser->wallet;
            $airtime->save();
            $randomUser->save();
        }
    }
}
