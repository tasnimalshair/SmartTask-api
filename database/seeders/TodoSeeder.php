<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Todo::query()->truncate();
        Schema::enableForeignKeyConstraints();

        Todo::query()->create([
            'title' => 'Cleaning the room',
            'description' => 'After shopping I will take a shower then cleaning the room',
            'is_completed' => false,
            'user_id' => 1,
            'category_id' => 1
        ]);

        Todo::query()->create([
            'title' => 'Going to the dancing class',
            'description' => 'Call my friend to go together to the class',
            'is_completed' => true,
            'user_id' => 3,
            'category_id' => 2
        ]);

        Todo::query()->create([
            'title' => 'Browsing Linkedin',
            'description' => 'After taking a rest of work, browse linkedin!',
            'is_completed' => false,
            'user_id' => 2,
            'category_id' => 3
        ]);
    }
}
