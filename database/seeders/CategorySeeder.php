<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 5 danh mục cha
        Category::factory(5)->create()->each(function ($category) {
            // Mỗi danh mục cha có 3 danh mục con
            Category::factory(3)->create([
                'parent_id' => $category->id
            ]);
        });
    }
}
