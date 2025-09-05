<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\PurchaseController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CategorySeeder::class,
            AuthorTableSeeder::class,
            BookTableSeeder::class,
            PurchaseTableSeeder::class,
        ]);
    }
}
