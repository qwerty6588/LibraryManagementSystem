<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;

class PurchaseTableSeeder extends Seeder
{
    public function run(): void
    {
        $purchases = [
            [
                'user_id' => 1,
                'book_id' => 1,
                'quantity' => 1,
                'total' => 50,
            ],
            [
                'user_id' => 2,
                'book_id' => 2,
                'quantity' => 2,
                'total' => 120,
            ],
            [
                'user_id' => 1,
                'book_id' => 3,
                'quantity' => 1,
                'total' => 75,
            ],
        ];

        foreach ($purchases as $purchase) {
            Purchase::create($purchase);
        }
    }
}
