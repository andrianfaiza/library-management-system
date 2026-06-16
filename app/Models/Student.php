<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'nis',
        'name',
        'class',
        'major',
        'phone_number',
        'email',
    ];

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'student_id');
    }
}
