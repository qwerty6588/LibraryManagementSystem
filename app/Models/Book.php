<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslatable;


/**
 * App\Models\Book
 * @property int $id
 * @property array $title
 * @property array $description
 * @property int $author_id
 * @property int $category_id
 * @property int $quantity
 * @property int|null $published_year
 * @property string|null $image
 * @property string|null $price
 * @property string|null $cover
 * @property string $author
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
        'image',
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

