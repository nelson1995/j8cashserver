<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use App\Repositories\Interfaces\PermissionInterface;

class PermissionRepository implements PermissionInterface
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function all()
    {
        return $this->permission->all();
    }

    public function show($id)
    {
        return $this->permission->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->permission->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->permission->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->permission->destroy($id);
    }

    public function setPermission(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function getPermission()
    {
        return $this->permission;
    }


    public function with($relations)
    {
        return $this->permission->with($relations);
    }
}
