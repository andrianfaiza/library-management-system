<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rack extends Model
{
    protected $table = 'racks';
    protected $fillable = [
        'name',
        'location',
        'capacity',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'rack_id');
    }
}
