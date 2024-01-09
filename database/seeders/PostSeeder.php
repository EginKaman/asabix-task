<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    private Collection $languages;
    /**
     * @var array|string[]
     */
    private array $fakerLocales = [
        'en' => 'en_US',
        'uk' => 'uk_UA',
        'ru' => 'ru_RU',
    ];

    public function __construct()
    {
        $this->languages = Language::all();

        if ($this->languages->isEmpty()) {
            throw new RecordsNotFoundException('First run language seeder first');
        }
    }

    public function run(): void
    {
        $translations = collect();

        Post::factory(500)->afterCreating(function (Post $post) use ($translations): void {
            $this->languages->each(function (Language $language) use ($translations, $post): void {
                config(['app.faker_locale' => $this->fakerLocales[$language->prefix]]);

                $translations->push(PostTranslation::factory()->make([
                    'post_id'     => $post->id,
                    'language_id' => $language->id,
                ]));
            });
        })->create();

        PostTranslation::insert($translations->toArray());
    }
}
