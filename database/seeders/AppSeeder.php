<?php

namespace Database\Seeders;

use Database\Seeders\Auth\PermissionRoleSeeder;
use Database\Seeders\Auth\UserRoleSeeder;
use Database\Seeders\Auth\UserSeeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\PermissionRegistrar;

/**
 * Class AppSeeder.
 */
class AppSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call(CountriesSeeder::class);
        $this->call(CodesSeeder::class);
        $this->call(IslandsSeeder::class);
    }
}
