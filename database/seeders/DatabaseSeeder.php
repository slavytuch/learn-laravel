<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProductSectionSeeder::class,
            ProductSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ProductPropertySeeder::class,
            ProductProductPropertySeeder::class,
        ]);
    }
}
