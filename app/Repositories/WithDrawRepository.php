<?php

namespace App\Repositories;

use App\WithDraw;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\WithDrawInterface;

class WithDrawRepository implements WithDrawInterface
{
    protected $withDraw;

    public function __construct(WithDraw $withDraw)
    {
        $this->withDraw = $withDraw;
    }

    public function all()
    {
        return $this->withDraw->all();
    }

    public function show($id)
    {
        return $this->withDraw->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->withDraw->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->withDraw->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->withDraw->destroy($id);
    }

    public function setWithDraw(WithDraw $withDraw)
    {
        $this->withDraw = $withDraw;
    }

    public function getWithDraw()
    {
        return $this->withDraw;
    }

    public function monthlyWithDraws()
    {
        return DB::table('with_draws')->select(DB::raw('count(id) as total'),DB::raw('month(created_at) as month'))
        ->where('status','=','SUCCESSFUL')
        ->groupBy('month')
        ->get();
    }
}
