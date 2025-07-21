<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    public function run(): void
    {
        $authors = ['George Orwell', 'J.K. Rowling', 'Stephen King', 'Isaac Asimov', 'Jane Austen'];

        foreach ($authors as $name) {
            Author::create(['name' => $name]);
        }
    }
}
