<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslatable;

/**
 * App\Models\Author
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Author create(array $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Author where($column, $operator = null, $value = null, $boolean = 'and')
 */
class Author extends Model
{
    use HasFactory, HasTranslatable;

    protected $fillable = ['name'];

    protected array $translatable = [
        'name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class , 'author_id');
    }
}

