<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTranslation extends Model
{
    use HasFactory;
    use HasUuids;

    public $timestamps = false;
    protected $fillable = [
        'post_id',
        'language_id',
        'title',
        'description',
        'content',
    ];

    protected $casts = [
        'post_id'     => 'string',
        'language_id' => 'string',
    ];

    protected $attributes = [
        'title'   => null,
        'content' => null,
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
