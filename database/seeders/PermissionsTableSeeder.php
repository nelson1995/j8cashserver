<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            "view-users",
            "edit-user",
            "delete-user",
            "create-forex-rates",
            "list-forex-rates",
            "edit-forex-rates",
            "delete-forex-rates",
            "list-administrators",
            "edit-administrators",
            "delete-administrators",
            "create-role",
            "list-roles",
            "view-role",
            "edit-role",
            "delete-role",
            "create-permission",
            "list-permissions",
            "edit-permission",
            "delete-permission",
        ];
        
        foreach($permissions as $permission){
            Permission::create(['name'=>$permission]);
        }
    }
}
