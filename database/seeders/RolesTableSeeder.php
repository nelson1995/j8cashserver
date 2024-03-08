<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::query()->get();
        // $permissions1 = Permission::query()->get();

        $role2 = Role::create(['name'=>"super-administrator"]);
        $role2->save();
        $role2->syncPermissions($permissions);

        $role = Role::create(['name'=>"administrator"]);
        $role->save();

        $role1 = Role::create(['name'=>"user"]);
        $role1->save();


        // for($i=0;$i<5;$i++){
        //     $randomPermissions = $permissions[rand(0,4)];
        //     $randomPermissions1 = $permissions1[rand(0,4)];
        //     $role->givePermissionTo($randomPermissions->name);
        //     $role1->givePermissionTo($randomPermissions1->name);
        // }


        // foreach($roles as $role){
        //     Role::create(['name'=>$role]);
        // }
    }
}
