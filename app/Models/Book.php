<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{

    protected $fillable = [
        'title',
        'author_id',
        'category_id',
        'description',
        'published_year',
        'quantity'];

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

