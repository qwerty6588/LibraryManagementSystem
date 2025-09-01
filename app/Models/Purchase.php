<?php

namespace App\Models;

use App\Traits\HasTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Purchase
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property int $quantity
 * @property float $total
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase create(array $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase where($column, $operator = null, $value = null, $boolean = 'and')
 */

class Purchase extends Model
{
    use HasFactory, HasTranslatable;

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
        'total',
    ];

    protected array $translatable = [
        'book_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}




