<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name'=>'Reagen Gilbert Pinontoan',
            'email'=> 'reagenpinontoan510@gmail.com',
            'password'=> bcrypt('password'),
            'phone'=>'082397757040',
            'is_admin'=>'admin'
        ]);

        User::create([
            'name'=>'Lidya Rusi Nuryasi',
            'email'=> 'lidyarusi71@gmail.com',
            'password'=> bcrypt('password'),
            'phone'=>'082347757040'
        ]);

        User::create([
            'name'=>'Timoti Jannes Sitompul',
            'email'=> 'tj71@gmail.com',
            'password'=> bcrypt('password'),
            'phone'=>'082397797040'
        ]);

        Category:: create([
            'name' => 'Food'
        ]);

        Category:: create([
            'name' => 'Beverage'
        ]);

        Category:: create([
            'name' => 'Stationery'
        ]);

        Category:: create([
            'name' => 'Electronics'
        ]);

        Category:: create([
            'name' => 'Home & Kitchen'
        ]);

        Category:: create([
            'name' => 'Cleaning'
        ]);

        Product::factory(10)->create();
    }
}
