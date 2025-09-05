<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'uz' => 'Badiiy adabiyot',
                'ru' => 'Художественная литература',
                'en' => 'Fiction',
            ],
            [
                'uz' => 'Fan',
                'ru' => 'Наука',
                'en' => 'Science',
            ],
            [
                'uz' => 'Biografiya',
                'ru' => 'Биография',
                'en' => 'Biography',
            ],
            [
                'uz' => 'Texnologiya',
                'ru' => 'Технология',
                'en' => 'Technology',
            ],
            [
                'uz' => 'Horror',
                'ru' => 'Хоррор',
                'en' => 'Horror',
            ],
            [
                'uz' => 'Fantastika',
                'ru' => 'Фэнтези',
                'en' => 'Fantasy',
            ],
        ];
        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
