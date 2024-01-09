<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class PostTranslationData extends Data
{
    public function __construct(public string $language_id, public string $title, public string $description, public string $content)
    {
    }
}
