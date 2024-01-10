<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class LanguageRepository
{
    public function getAll(): Collection
    {
        return Language::get();
    }
}
