<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BookTableSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => [
                    'uz' => '1984',
                    'ru' => '1984',
                    'en' => '1984',
                ],
                'author' => 'George Orwell',
                'category' => 'Fiction',
                'year' => 1949,
                'description' => [
                    'en' => 'Dystopian novel about totalitarianism',
                    'ru' => 'Роман-антиутопия о тоталитаризме',
                    'uz' => 'Totalitarizm haqidagi distopik roman',
                ]
            ],
            [
                'title' => [
                    'uz' => 'Garri Potter',
                    'ru' => 'Гарри Поттер',
                    'en' => 'Harry Potter',
                ],
                'author' => 'J.K. Rowling',
                'category' => 'Fantasy',
                'year' => 1997,
                'description' => [
                    'en' => 'Harry Potter description',
                    'ru' => 'Описание Гарри Поттера',
                    'uz' => 'Garri Potterning tavsifi',
                ]
            ],
            [
                'title' => [
                    'uz' => 'Orqinlik',
                    'ru' => 'Сияние',
                    'en' => 'The Shining',
                ],
                'author' => 'Stephen King',
                'category' => 'Horror',
                'year' => 1977,
                'description' => [
                    'uz' => 'Totalitarizm haqidagi distopik roman',
                    'ru' => 'Отель с привидениями сводит с ума своего смотрителя',
                    'en' => 'A haunted hotel drives its caretaker insane',
                ]
            ],
            [
                'title' => [
                    'uz' => 'Mag‘rurlik va xurofot',
                    'ru' => 'Гордость и предубеждение',
                    'en' => 'Pride and Prejudice',
                ],
                'author' => 'Jane Austen',
                'category' => 'Biography',
                'year' => 1813,
                'description' => [
                    'en' => 'A romantic novel set in early 19th-century England',
                    'uz' => '19-asr boshidagi Angliyada yozilgan romantik roman',
                    'ru' => 'Действие романтического романа происходит в Англии начала 19 века',
                ]
            ],
        ];

        foreach ($books as $data) {
            $author = Author::where('name->en', $data['author'])->first();
            $category = Category::where('name->en', $data['category'])->first();

            if ($author && $category) {
                Book::create([
                    'title'          => $data['title'],
                    'author_id'      => $author->id,
                    'category_id'    => $category->id,
                    'description'    => $data['description'],
                    'published_year' => $data['year'],
                    'quantity'       => 10,
                    'price'          => rand(50, 500),
                ]);
            }
        }
    }
}
