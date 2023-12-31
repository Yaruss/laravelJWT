<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.ru',
            'password' => 'test'
        ]);
        User::factory()->create([
            'name' => 't1',
            'email' => 'test1@test.ru',
        ]);
    }
}


