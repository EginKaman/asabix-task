<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PostTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostTranslationFactory extends Factory
{
    protected $model = PostTranslation::class;

    public function definition(): array
    {
        return [
            'id'          => Str::orderedUuid(),
            'title'       => fake(config('app.faker_locale'))->realText(100),
            'description' => fake(config('app.faker_locale'))->realText(5000),
            'content'     => fake(config('app.faker_locale'))->realText(5000),
        ];
    }
}
