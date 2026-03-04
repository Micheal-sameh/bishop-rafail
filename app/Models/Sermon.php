<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sermon extends Model implements HasMedia
{
    use HasCreatedBy;
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'url',
        'sermon_playlist_id',
        'created_by',
    ];

    public function playlist(): BelongsTo
    {
        return $this->belongsTo(SermonPlaylist::class, 'sermon_playlist_id');
    }
}
