<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //add sample data to category table
        $categories=[
            'news',
            'article',
            'picture',
            'video'
        ];

        //looping and insert data
        foreach ($categories as $categoriy) {
            category::create(['name'=>$categoriy]);
            // code...
        }
    }
}
