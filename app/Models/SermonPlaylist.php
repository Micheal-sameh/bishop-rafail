<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SermonPlaylist extends Model
{
    use HasFactory;

    protected $table = 'sermons_playlists';

    protected $fillable = [
        'title',
        'type',
    ];

    public function sermons(): HasMany
    {
        return $this->hasMany(Sermon::class, 'sermon_playlist_id');
    }
}
