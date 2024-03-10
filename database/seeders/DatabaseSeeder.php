<?php

use Illuminate\Database\Seeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\ExchangeRateTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(ExchangeRateTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        // $this->call(DepositsTableSeeder::class);
        // $this->call(WithDrawSeeder::class);
        // $this->call(AirtimeTableSeeder::class);
        // $this->call(TransferTableSeeder::class);
    }
}
