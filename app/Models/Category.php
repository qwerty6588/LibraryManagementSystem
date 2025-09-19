<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslatable;

/**
 * App\Models\Category
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|Category create(array $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category where($column, $operator = null, $value = null, $boolean = 'and')
 */
class Category extends Model
{
    use HasFactory, HasTranslatable;

    protected $fillable = ['name'];

    protected array $translatable = [
        'name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_id');
    }
}

