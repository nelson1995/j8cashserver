<?php

use App\ExchangeRate;
use App\Http\Traits\CurrentDateTimeTrait;
use Illuminate\Database\Seeder;

class ExchangeRateTableSeeder extends Seeder
{
    use CurrentDateTimeTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exchangeRate = new ExchangeRate;
        $exchangeRate->from_country="Uganda";
        $exchangeRate->from_currency="UGX";
        $exchangeRate->rate=0.0051;
        $exchangeRate->to_country="Zambia";
        $exchangeRate->to_currency="ZMW";
        $exchangeRate->date=$this->getDateTime("Uganda");
        $exchangeRate->save();

        $exchangeRate1 = new ExchangeRate;
        $exchangeRate1->from_country="Uganda";
        $exchangeRate1->from_currency="UGX";
        $exchangeRate1->rate=0.03;
        $exchangeRate1->to_country="Kenya";
        $exchangeRate1->to_currency="KES";
        $exchangeRate1->date=$this->getDateTime("Uganda");
        $exchangeRate1->save();

        $exchangeRate2 = new ExchangeRate;
        $exchangeRate2->from_country="Uganda";
        $exchangeRate2->from_currency="UGX";
        $exchangeRate2->rate=0.26;
        $exchangeRate2->to_country="Rwanda";
        $exchangeRate2->to_currency="RWF";
        $exchangeRate2->date=$this->getDateTime("Uganda");
        $exchangeRate2->save();

        $exchangeRate3 = new ExchangeRate;
        $exchangeRate3->from_country="Rwanda";
        $exchangeRate3->from_currency="RWF";
        $exchangeRate3->rate=0.11;
        $exchangeRate3->to_country="Kenya";
        $exchangeRate3->to_currency="KES";
        $exchangeRate3->date=$this->getDateTime("Uganda");
        $exchangeRate3->save();

        $exchangeRate4 = new ExchangeRate;
        $exchangeRate4->from_country="Rwanda";
        $exchangeRate4->from_currency="RWF";
        $exchangeRate4->rate=0.019;
        $exchangeRate4->to_country="Zambia";
        $exchangeRate4->to_currency="ZMW";
        $exchangeRate4->date=$this->getDateTime("Uganda");
        $exchangeRate4->save();

        $exchangeRate10 = new ExchangeRate;
        $exchangeRate10->from_country="Rwanda";
        $exchangeRate10->from_currency="RWF";
        $exchangeRate10->rate=3.82;
        $exchangeRate10->to_country="Uganda";
        $exchangeRate10->to_currency="UGX";
        $exchangeRate10->date=$this->getDateTime("Uganda");
        $exchangeRate10->save();

        $exchangeRate5 = new ExchangeRate;
        $exchangeRate5->from_country="Zambia";
        $exchangeRate5->from_currency="ZMW";
        $exchangeRate5->rate=5.81;
        $exchangeRate5->to_country="Kenya";
        $exchangeRate5->to_currency="KES";
        $exchangeRate5->date=$this->getDateTime("Uganda");
        $exchangeRate5->save();

        $exchangeRate8 = new ExchangeRate;
        $exchangeRate8->from_country="Zambia";
        $exchangeRate8->from_currency="ZMW";
        $exchangeRate8->rate=195.74;
        $exchangeRate8->to_country="Uganda";
        $exchangeRate8->to_currency="UGX";
        $exchangeRate8->date=$this->getDateTime("Uganda");
        $exchangeRate8->save();

        $exchangeRate9 = new ExchangeRate;
        $exchangeRate9->from_country="Zambia";
        $exchangeRate9->from_currency="ZMW";
        $exchangeRate9->rate=51.44;
        $exchangeRate9->to_country="Rwanda";
        $exchangeRate9->to_currency="RWF";
        $exchangeRate9->date=$this->getDateTime("Uganda");
        $exchangeRate9->save();

        $exchangeRate6 = new ExchangeRate;
        $exchangeRate6->from_country="Kenya";
        $exchangeRate6->from_currency="KES";
        $exchangeRate6->rate=0.17;
        $exchangeRate6->to_country="Zambia";
        $exchangeRate6->to_currency="ZMW";
        $exchangeRate6->date=$this->getDateTime("Uganda");
        $exchangeRate6->save();

        $exchangeRate7 = new ExchangeRate;
        $exchangeRate7->from_country="Kenya";
        $exchangeRate7->from_currency="KES";
        $exchangeRate7->rate=33.87;
        $exchangeRate7->to_country="Uganda";
        $exchangeRate7->to_currency="UGX";
        $exchangeRate7->date=$this->getDateTime("Uganda");
        $exchangeRate7->save();

        $exchangeRate7 = new ExchangeRate;
        $exchangeRate7->from_country="Kenya";
        $exchangeRate7->from_currency="KES";
        $exchangeRate7->rate=8.9;
        $exchangeRate7->to_country="Rwanda";
        $exchangeRate7->to_currency="RWF";
        $exchangeRate7->date=$this->getDateTime("Uganda");
        $exchangeRate7->save();
    }
}
