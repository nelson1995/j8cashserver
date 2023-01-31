<?php

namespace App\Repositories;

use App\Deposit;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\DepositInterface;

class DepositRepository implements DepositInterface
{
    protected $deposit;

    public function __construct(Deposit $deposit)
    {
        $this->deposit = $deposit;
    }

    public function all()
    {
        return $this->deposit->all();
    }

    public function show($id)
    {
        return $this->Deposit->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->Deposit->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->Deposit->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->Deposit->destroy($id);
    }

    public function setDeposit(Deposit $deposit)
    {
        $this->deposit = $deposit;
    }

    public function getDeposit()
    {
        return $this->deposit;
    }

    public function monthlyDeposits()
    {   
        return DB::table('deposits')->select(DB::raw('count(id) as total'),DB::raw('month(created_at) as month'))
        ->groupBy('month')
        ->get();   
    }
}
