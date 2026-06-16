<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    protected $table = 'loans';
    protected $fillable = [
        'student_id',
        'user_id',
        'loan_date',
        'return_date',
        'status',
    ];

    protected $casts = [
        'loan_date' => 'date',
        'return_date' => 'date',
    ];

    public function returns(): HasMany
    {
        return $this->hasMany(BookReturn::class, 'loan_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(LoanDetail::class, 'loan_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
