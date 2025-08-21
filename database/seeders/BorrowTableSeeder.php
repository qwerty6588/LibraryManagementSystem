<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrowing;

class BorrowTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $books = Book::all();

        foreach ($users as $user) {
            $randomBooks = $books->random(min(2, $books->count()));

            foreach ($randomBooks as $book) {
                Borrowing::create([
                    'user_id'     => $user->id,
                    'book_id'     => $book->id,
                    'borrowed_at' => now()->subDays(rand(5, 30)),
                    'returned_at' => rand(0, 1) ? now() : null,
                ]);
            }
        }
    }
}
