<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'id'         => Str::orderedUuid(),
            'created_at' => $createdAt = $this->faker->dateTimeBetween('-1 year'),
            'updated_at' => $this->faker->dateTimeBetween($createdAt),
        ];
    }
}
