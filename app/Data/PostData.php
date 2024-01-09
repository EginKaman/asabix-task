<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Data;

class PostData extends Data
{
    public function __construct(public array $translations, public array $tags)
    {
    }
}
