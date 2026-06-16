<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = [
        'isbn',
        'title',
        'publisher',
        'publication_year',
        'author',
        'rack_id',
        'quantity',
    ];

    public function rack(): BelongsTo
    {
        return $this->belongsTo(Rack::class, 'rack_id');
    }
    public function details(): HasMany
    {
        return $this->hasMany(LoanDetail::class, 'book_id');
    }
}
