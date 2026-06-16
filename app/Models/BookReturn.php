<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookReturn extends Model
{
    protected $table = 'book_returns';
    protected $fillable = [
        'loan_id',
        'return_date',
        'fine',
        'user_id',
    ];

    protected $casts = [
        'return_date' => 'date',
    ];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
