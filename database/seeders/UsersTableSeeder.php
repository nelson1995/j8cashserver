<?php

namespace Database\Seeders;

use App\User;
use App\Country;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = new User();
        // $user->name = "Super Administrator";
        // $user->username = "super-admin";
        // $user->phone = "243700000001";
        // $user->email = "super_admin@j8cash.com";
        // $user->password = bcrypt("admin1234");
        // $user->role="";
        // $user->save();
        // $role = Role::query()->where('name','super-administrator')->first();
        // $user->assignRole($role);
        // $role = Role::where('name','administrator')->first();
        // $faker = Faker\Factory::create();
        // $country = Country::query()->get();
        // for($i=0;$i<5;$i++){
        //     $user1 = new User();
        //     $user1->name = $faker->firstName();
        //     $user1->username = $faker->userName;
        //     $user1->phone = $faker->phoneNumber;
        //     $user1->email = $faker->email;
        //     $user1->password = bcrypt("secret");
        //     $user1->wallet = '10000';
        //     $user1->role="";
        //     $user1->save();
        //     $user1->assignRole($role);
        //     $randCountry = $country[rand(0,3)];
        //     $user1->country()->attach($randCountry);
        // }

        $role = Role::where('name','user')->first();
        $faker = Faker\Factory::create();
        $country = Country::query()->get();
        for($i=0;$i<5;$i++){
            $user1 = new User();
            $user1->name = $faker->firstName();
            $user1->username = $faker->userName;
            $user1->phone = $faker->phoneNumber;
            $user1->email = $faker->email;
            $user1->password = bcrypt("secret");
            $user1->wallet = '10000';
            $user1->role="";
            $user1->save();
            $user1->assignRole($role);
            $randCountry = $country[rand(0,3)];
            $user1->country()->attach($randCountry);
        }
    }
}
