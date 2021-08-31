<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'        => 'General',
            'slug'        => 'general',
            'description' => 'General category',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        Category::create([
            'name'        => 'Ladies',
            'slug'        => 'ladies',
            'description' => 'This is the ladies category where you can get all kinds of ladies accessories',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        Category::create([
            'name'        => 'Gents',
            'slug'        => 'gents',
            'description' => 'This is the gents category where you can get all kinds of gents accessories',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);      
        Category::create([
            'name'        => 'Baby',
            'slug'        => 'baby',
            'description' => 'This is the babies category where you can get all kinds of babies accessories',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        Category::create([
            'name'        => 'Technology',
            'slug'        => 'technology',
            'description' => 'This is the technology category where you can get all kinds of technology accessories',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
