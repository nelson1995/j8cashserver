<?php

namespace App\Repositories;

use App\ExchangeRate;
use App\Http\Traits\CurrentDateTimeTrait;
use App\Repositories\Interfaces\ExchangeRateInterface;

class ExchangeRateRepository implements ExchangeRateInterface{

    use CurrentDateTimeTrait;

    protected $exchangeRate;

    public function __construct(ExchangeRate $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }
    
    public function all()
    {
        return $this->exchangeRate->all();
    }

    public function show($id)
    {
        return $this->exchangeRate->findOrFail($id);
    }
    
    public function create(array $data)
    {
        $data += ["date"=>$this->getDateTime("Uganda")];
        return $this->exchangeRate->create($data);
    }

    public function update(array $data,$id)
    {
        $record = $this->exchangeRate->find($id);
        $data += ["date"=>$this->getDateTime("Uganda")];
        return $record->update($data);

    }

    public function delete($id)
    {
        return $this->exchangeRate->destroy($id);
    }

    public function setExchangeRate(ExchangeRate $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }

    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    public function with(array $relations)
    {
        return $this->exchangeRate->with($relations);
    }

}