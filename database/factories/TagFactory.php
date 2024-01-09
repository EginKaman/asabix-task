<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'id'          => Str::orderedUuid(),
            'name'        => $this->faker->name(),
            'created_at'  => $createdAt = $this->faker->dateTimeBetween('-1 year'),
            'updated_at'  => $this->faker->dateTimeBetween($createdAt),
        ];
    }
}
