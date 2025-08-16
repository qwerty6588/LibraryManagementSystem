<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => json_encode([
                    'uz'    => '1984',
                    'ru'     => '1984',
                    'en'     => '1984',
                ]),
                'author' => 'George Orwell',
                'category' => 'Fiction',
                'year' => 1949,
                'description' => json_encode([
                    'en'    =>  'Dystopian novel about totalitarianism. en',
                    'ru'    =>  'Dystopian novel about totalitarianism. ru',
                    'uz' => 'Dystopian novel about totalitarianism. uz'
                ])
            ],
            [
                'title' => json_encode([
                    'uz'    => 'Harry Potter uz',
                    'ru'     => 'Harry Potter ru',
                    'en'     => 'Harry Potter, en',
                ]),
                'author' => 'J.K. Rowling',
                'category' => 'Fantasy',
                'year' => 1997,
                'description' => json_encode([
                    'en'    =>  'Harry Potter description EN',
                    'ru'    =>  'Harry Potter description ru',
                    'uz' => 'Harry Potter description uz',
                ])
            ],
            [
                'title' => json_encode([
                    'uz' => 'The Shining uz',
                    'ru' => 'The Shining ru',
                    'en' => 'The Shining en',
                ]),
                'author' => 'Stephen King',
                'category' => 'Horror',
                'year' => 1977,
                'description' => json_encode([
                    'uz' => 'A haunted hotel drives its caretaker insane .uz',
                    'ru' => 'A haunted hotel drives its caretaker insane  ru',
                    'en' => 'A haunted hotel drives its caretaker insane .en',
                ])
            ],
            [
                'title' => json_encode([
                    'uz' => 'The Shining uz',
                    'ru' => 'The Shining ru',
                    'en' => 'The Shining en',
                ]),
                'author' => 'Isaac Asimov',
                'category' => 'Science',
                'year' => 1950,
                'description' => json_encode([
                    'en' => 'The Shining description EN',
                    'ru' => 'The Shining description ru',
                    'uz' => 'The Shining description uz',
                ])
            ],
            [
                'title' => json_encode([
                    'uz' => 'Pride and Prejudice uz',
                    'ru' => 'Pride and Prejudice ru',
                    'en' => 'Pride and Prejudice en',
                ]),
                'author' => 'Jane Austen',
                'category' => 'Biography',
                'year' => 1813,
                'description' => json_encode([
                    'en' => 'A romantic novel set in early 19th-century England. en',
                    'uz' => 'A romantic novel set in early 19th-century England. uz',
                    'ru' => 'A romantic novel set in early 19th-century England. ru',
                ])
            ],
        ];

        foreach ($books as $data) {
            $author = Author::firstOrCreate(['name' => $data['author']]);
            $category = Category::firstOrCreate(['name' => $data['category']]);

            Book::create([
                'title' => $data['title'],
                'author_id' => $author->id,
                'category_id' => $category->id,
                'description' => $data['description'],
                'published_year' => $data['year'],
            ]);
        }
    }
}
