<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
    ];

    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class, 'subject_id');
    }
}
