<?php

namespace App\Repositories;

use App\Transfer;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\TransferInterface;

class TransferRepository implements TransferInterface
{
    protected $transfer;

    public function __construct(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }

    public function all()
    {
        return $this->transfer->all();
    }

    public function show($id)
    {
        return $this->transfer->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->transfer->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->transfer->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->transfer->destroy($id);
    }

    public function setTransfer(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }

    public function getTransfer()
    {
        return $this->transfer;
    }

    public function monthlyTransfers()
    {
        return DB::table('transfers')->select(DB::raw('count(id) as total'),DB::raw('month(created_at) as month'))
        ->groupBy('month')
        ->get();
    }
}
