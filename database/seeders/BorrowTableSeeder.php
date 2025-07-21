<?php

namespace Database\Seeders;

use App\Models\Borrowing;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BorrowTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $books = Book::all();

        foreach ($users as $user) {
            foreach ($books->random(2) as $book) {
                Borrowing::create([
                    'user_id' => 1,
                    'book_id' => 2,
                    'borrowed_at' => now()->subDays(16),
                    'returned_at' => now(),
                ]);
            }
        }
    }
}

