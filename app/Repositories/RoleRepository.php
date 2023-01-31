<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\Interfaces\RoleInterface;

class RoleRepository implements RoleInterface
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function all()
    {
        return $this->role->all();
    }

    public function getRoleByName($name)
    {
        return $this->role->where('name',$name)->first();
    }

    public function show($id)
    {
        return $this->role->findOrFail($id);
    }

    public function create(array $data)
    {
        $result = $this->role->create($data);
        $permissions = Permission::query()->whereIn('id',$data['permissions'])->get();
        $role = $this->role->where('name',$data['name'])->first();
        $role->syncPermissions($permissions);
        return $result;
    }

    public function update(array $data, $id)
    {
        $permissions = Permission::query()->whereIn('id',$data['permissions'])->get();
        $role = $this->role->find($id);
        $result = $role->update($data);
        $role->syncPermissions($permissions);
        return $result;
    }

    public function delete($id)
    {
        return $this->role->destroy($id);
    }

    public function setRole(Role $role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }


    public function with($relations)
    {
        return $this->role->with($relations);
    }
}