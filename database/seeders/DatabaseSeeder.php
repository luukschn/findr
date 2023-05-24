<?php

namespace Database\Seeders;

use App\Models\Scale;
use App\Models\ScaleQuestion;
use App\Models\ExtendedUserInfo;
use App\Models\ScaleResult;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //create admin user
        User::insert([
            'name' => 'luuk',
            'email' => 'q@q.com',
            'password' => Hash::make('luuk'),
            'is_admin' => 1
        ]);

        User::factory()
            ->count(20)
            ->has(ExtendedUserInfo::factory())
            ->create();

        Scale::factory()
            ->count(3)
            ->has(ScaleQuestion::factory()->count(random_int(5, 20)))
            ->has(ScaleResult::factory()->count(random_int(2, 20)))
            ->create();
    }
}
