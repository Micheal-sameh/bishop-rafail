<?php

namespace App\Models;

use App\Traits\HasCreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SermonPlaylist extends Model
{
    use HasCreatedBy;
    use HasFactory;

    protected $table = 'sermons_playlists';

    protected $fillable = [
        'title',
        'type',
        'created_by',
    ];

    public function sermons(): HasMany
    {
        return $this->hasMany(Sermon::class, 'sermon_playlist_id');
    }
}
