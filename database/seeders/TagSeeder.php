<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    private Collection $posts;

    public function __construct()
    {
        $this->posts = Post::inRandomOrder()->limit(50)->get();

        if ($this->posts->isEmpty()) {
            throw new RecordsNotFoundException('First run post seeder first');
        }
    }

    public function run(): void
    {
        Tag::factory(100)->afterMaking(function (Tag $tag): void {
            $tag->posts()->attach($this->posts->random(random_int(2, 5)));
        })->create();
    }
}
