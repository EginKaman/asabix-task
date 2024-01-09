<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        Language::create([
            'prefix' => 'en',
            'locale' => 'English',
        ]);
        Language::create([
            'prefix' => 'uk',
            'locale' => 'Ukrainian',
        ]);
        Language::create([
            'prefix' => 'ru',
            'locale' => 'Russian',
        ]);
    }
}
