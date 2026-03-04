<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasCreatedBy;
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'created_by',
    ];
}
