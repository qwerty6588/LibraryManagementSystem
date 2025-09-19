<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorTableSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'uz' => 'Jorj Oruell',
                'ru' => 'Джордж Оруэлл',
                'en' => 'George Orwell',
            ],
            [
                'uz' => 'J.K. Rouling',
                'ru' => 'Дж.К. Роулинг',
                'en' => 'J.K. Rowling',
            ],
            [
                'uz' => 'Stiven King',
                'ru' => 'Стивен Кинг',
                'en' => 'Stephen King',
            ],
            [
                'uz' => 'Isaak Asimov',
                'ru' => 'Айзек Азимов',
                'en' => 'Isaac Asimov',
            ],
            [
                'uz' => 'Jeyn Osten',
                'ru' => 'Джейн Остин',
                'en' => 'Jane Austen',
            ],
        ];

        foreach ($authors as $name) {
            Author::create([
                'name' => $name]);
        }

    }
}
