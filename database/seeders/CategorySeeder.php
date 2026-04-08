<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $categories = [
        ['name' => 'Harian', 'slug' => 'harian'],
        ['name' => 'Mingguan', 'slug' => 'mingguan'],
        ['name' => 'Bulanan', 'slug' => 'bulanan'],
        ['name' => 'Tahunan', 'slug' => 'tahunan'],
    ];

    DB::table('categories')->insert($categories);
    }
}
