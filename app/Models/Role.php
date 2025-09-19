<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\User
 * @property int $id
 * @property string $name
 * @property string $email
 * @method static \Illuminate\Database\Eloquent\Builder|User create(array $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User where($column, $operator = null, $value = null, $boolean = 'and')
 */
class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name'
    ];


    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
