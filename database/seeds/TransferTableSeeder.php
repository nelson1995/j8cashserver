<?php

use App\User;
use App\Transfer;
use Illuminate\Database\Seeder;
use App\Http\Traits\CurrentDateTimeTrait;
use Illuminate\Database\Eloquent\Builder;

class TransferTableSeeder extends Seeder
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
        $senders = User::query()->whereHas('roles',
            function(Builder $query) use ($roleName){
                $query->where('name','=',$roleName);
            }
        )->get();

        $receivers = User::query()->whereHas('roles',
            function(Builder $query) use ($roleName){
                $query->where('name','=',$roleName);
            }
        )->get();

        for($i=0;$i<10;$i++){
            $randomSender = $senders[rand(0,3)];
            $randomReceiver = $receivers[rand(0,3)];

            $transfer = new Transfer;
            $transfer->sender_id = $randomSender->id;
            $transfer->receiver_id = $randomReceiver->id;
            $transfer->amount = 1000;
            $transfer->converted_amount=500;
            $transfer->sender_date = $this->getDateTime("Uganda");
            $transfer->receiver_date = $this->getDateTime("Uganda");
            $transfer->text = 'Sending money';

            $randomSender->wallet = $randomSender->wallet - $transfer->amount;
            $randomReceiver->wallet = $randomReceiver->wallet + $transfer->amount;

            $transfer->save();
            $randomReceiver->save();
            $randomSender->save();
        }
    }
}
