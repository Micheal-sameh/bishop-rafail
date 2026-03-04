<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasCreatedBy;
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'created_by',
    ];

    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class, 'subject_id');
    }
}
