<?php

use App\User;
use App\WithDraw;
use Illuminate\Database\Seeder;
use App\Http\Traits\CurrentDateTimeTrait;
use Illuminate\Database\Eloquent\Builder;

class WithDrawSeeder extends Seeder
{
    use CurrentDateTimeTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleName= 'user';
        $users = User::query()->whereHas('roles',
            function(Builder $query) use ($roleName){
                $query->where('name','=',$roleName);
            })->get();
        
        for($i=0;$i<10;$i++){
            $randomUser = $users[rand(0,3)];
            $withdraw = new WithDraw;
            $withdraw->amount = 2000;
            $withdraw->phone = $randomUser->phone;
            $withdraw->user_id = $randomUser->id;
            $withdraw->date = $this->getDateTime("Uganda");
            $withdraw->tx_ref = "1234567890";
            // update user's wallet balance
            $withdraw->wallet_balance = $randomUser->wallet-2000;
            $randomUser->wallet = $withdraw->wallet_balance;
            $withdraw->save();
            $randomUser->save();
        }
    }
}
