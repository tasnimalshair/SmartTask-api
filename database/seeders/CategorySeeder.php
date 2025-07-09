<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::query()->truncate();
        Schema::enableForeignKeyConstraints();

        $categories = [
            [
                'name' => 'Cleaning',
                'user_id' => 1
            ],

            [
                'name' => 'Dancing',
                'user_id' => 2
            ],

            [
                'name' => 'Browing',
                'user_id' => 3
            ],
        ];

        foreach ($categories as $category) {
            Category::query()->create([
                'name' => $category['name'],
                'user_id' => $category['user_id'],
            ]);
        }
    }
}
