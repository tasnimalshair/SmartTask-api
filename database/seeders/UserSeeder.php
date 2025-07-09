<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::query()->truncate();
        Schema::enableForeignKeyConstraints();

        User::query()->create([
            'name' => 'Tasnim Alshair',
            'email' => 'tasnim@gmail.com',
            'password' => Hash::make('123456')
        ]);

        User::query()->create([
            'name' => 'Yanal Amr',
            'email' => 'yanalamr@gmail.com',
            'password' => Hash::make('654321')
        ]);

         User::query()->create([
            'name' => 'Toqa Jamil',
            'email' => 'toqa@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
