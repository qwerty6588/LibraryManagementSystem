<?php

namespace App\Models;

use App\Traits\HasTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder|static create(array $attributes = [])
 */
class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_id',
        'book_id',
        'quantity',
        'price'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
