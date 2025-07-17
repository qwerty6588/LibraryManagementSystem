<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    Use SoftDeletes;
    protected $fillable = ['name'];

    public function books()
    {
        return $this->hasMany(Book::class , 'author_id');
    }
}

