<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{    
    protected $fillable=['from_country','from_currency','rate','to_currency','to_country','date'];
}
