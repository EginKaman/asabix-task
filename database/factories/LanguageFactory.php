<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Language>
 */
class LanguageFactory extends Factory
{
    protected $model = Language::class;

    public function definition(): array
    {
        return [
            'id'          => Str::orderedUuid(),
            'locale'      => $this->faker->word(),
            'prefix'      => $this->faker->languageCode(),
        ];
    }
}
