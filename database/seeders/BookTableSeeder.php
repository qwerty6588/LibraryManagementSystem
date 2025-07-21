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
                'title' => '1984',
                'author' => 'George Orwell',
                'category' => 'Fiction',
                'year' => 1949,
                'description' => 'Dystopian novel about totalitarianism.'
            ],
            [
                'title' => 'Harry Potter',
                'author' => 'J.K. Rowling',
                'category' => 'Fantasy',
                'year' => 1997,
                'description' => 'A young wizard attends a magical school.'
            ],
            [
                'title' => 'The Shining',
                'author' => 'Stephen King',
                'category' => 'Horror',
                'year' => 1977,
                'description' => 'A haunted hotel drives its caretaker insane.'
            ],
            [
                'title' => 'I, Robot',
                'author' => 'Isaac Asimov',
                'category' => 'Science',
                'year' => 1950,
                'description' => 'A collection of short stories about robots.'
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'category' => 'Biography',
                'year' => 1813,
                'description' => 'A romantic novel set in early 19th-century England.'
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
