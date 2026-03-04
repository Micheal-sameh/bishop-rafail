<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasCreatedBy;
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'created_by',
    ];
}
