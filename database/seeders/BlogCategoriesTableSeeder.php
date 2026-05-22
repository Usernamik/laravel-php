<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BlogCategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('blog_categories')->truncate();
        DB::table('blog_posts')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $categories = [];

        $cName = 'Без категорії';
        $categories[] = [
            'title'     => $cName,
            'slug'      => Str::slug($cName),
            'parent_id' => 0,
        ];

        for ($i = 1; $i <=10; $i++) {
            $cName = 'Категорія #'.$i;
            $parentId = ($i > 4) ? rand(1, 4) : 1;

            $categories[] = [
                'title'     => $cName,
                'slug'      => Str::slug($cName),
                'parent_id' => $parentId,
            ];
        }

        DB::table('blog_categories')->insert($categories);
    }
}
