<?php

namespace App\Repositories;
/* 
    Author: Nelson Katale
    date :27/08/2020
*/
use App\User;
use App\Country;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Interfaces\UserInterface;

class UserRepository implements UserInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->all();
    }

    public function getUsersByRole($roleName)
    {    
        return $this->user->whereHas('roles',function(Builder $query) use ($roleName){
            $query->where('name',$roleName);
        })->get();
    }

    public function show($id)
    {
        return $this->user->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->user->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->user->destroy($id);
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function registeredUsersPerMonth()
    {
        $role = Role::query()->where('name','user')->first();
     
        return DB::table('users')
        ->select(DB::raw('count(id) as total'),DB::raw('month(created_at) as month'))
        ->join('model_has_roles',function($join) use ($role){
            $join->on('model_has_roles.model_id','=','users.id')
            ->where('model_has_roles.role_id',$role->id);
        })
        ->groupBy('month')
        ->get();
    }

    public function totalUsersPerCountry()
    {   
        return Country::query()->select('country')->withCount(['users','users as user_count' => function($query){
            $query->whereHas('roles',function(Builder $innerQuery){
                $innerQuery->where('name','=','user');
            });    
        }])->get(); 
        // return Country::query()->select('country')->withCount('users')->get(); 
    }
}
