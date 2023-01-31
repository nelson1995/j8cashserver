<?php

namespace App\Repositories;

use App\Airtime;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\AirtimeInterface;

class AirtimeRepository implements AirtimeInterface
{
    protected $airtime;

    public function __construct(Airtime $airtime)
    {
        $this->airtime = $airtime;
    }

    public function all()
    {
        return $this->airtime->all();
    }

    public function show($id)
    {
        return $this->airtime->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->airtime->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->airtime->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->airtime->destroy($id);
    }

    public function setAirtime(Airtime $airtime)
    {
        $this->airtime = $airtime;
    }

    public function getAirtime()
    {
        return $this->airtime;
    }


    public function with($relations)
    {
        return $this->airtime->with($relations);
    }

    public function sumOfAirtimeTransactions()
    {
        return DB::table('airtimes')->select(DB::raw('count(id) as total'),DB::raw('month(created_at) as month'))
        ->where('status','=','SUCCESSFUL')
        ->groupBy('month')
        ->get();
    }
}
