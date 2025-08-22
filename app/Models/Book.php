<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslatable;


/**
 * App\Models\Book
 * @property int $id
 * @property string $title
 * @property string $author
 * @property float $price
 * @property string $cover
 * @property int $author_id
 * @property int $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|Book create(array $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Book where($column, $operator = null, $value = null, $boolean = 'and')
 */
class Book extends Model
{
    use HasFactory, HasTranslatable;

    protected $fillable = [
        'title',
        'author_id',
        'category_id',
        'description',
        'published_year',
        'quantity',
        'price',
    ];

    protected array $translatable = [
        'title',
        'description',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class, 'borrowings_id');
    }
}

