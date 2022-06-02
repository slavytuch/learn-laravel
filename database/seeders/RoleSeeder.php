<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin', 'ability' => '*']);
        Role::create(['name' => 'test2', 'ability' => 'test2']);
        Role::create(['name' => 'test3', 'ability' => 'test3']);
        Role::create(['name' => 'test4', 'ability' => 'test4']);
        Role::create(['name' => 'test5', 'ability' => 'test5']);
    }
}
