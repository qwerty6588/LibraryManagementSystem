<?php

namespace App\Models;

use App\Traits\HasTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Borrowing
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing create(array $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Borrowing where($column, $operator = null, $value = null, $boolean = 'and')
 */
class Borrowing extends Model
{
    use HasTranslatable;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'returned_at'];

    protected array $translatable = [
        'book_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}

