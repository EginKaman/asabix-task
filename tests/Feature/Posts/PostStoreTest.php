<?php

declare(strict_types=1);

namespace Posts;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * @internal
 *
 * @small
 */
final class PostStoreTest extends TestCase
{
    use RefreshDatabase;

    private string $route = 'api.posts.store';

    public function testBasic(): void
    {
        $response = $this->options(route($this->route));

        $response->assertHeader('allow', 'GET,HEAD,POST');
    }

    public function testTranslationsValidation(): void
    {
        $this->post(route($this->route))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations',
            ]);

        $this->post(route($this->route), [
            'translations' => 'asdf',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations',
            ]);

        $this->post(route($this->route), [
            'translations' => [],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations',
            ]);
    }

    public function testTranslationsTitleValidation(): void
    {
        $this->post(route($this->route), [
            'translations' => [
                [
                    'title' => '',
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.title',
            ]);

        $this->post(route($this->route), [
            'translations' => [
                0 => [
                    'title' => str_repeat('a', 2),
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.title',
            ]);

        $this->post(route($this->route), [
            'translations' => [
                [
                    'title' => str_repeat('a', 256),
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.title',
            ]);

        $this->post(route($this->route), [
            'translations' => [
                [
                    'title' => [],
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.title',
            ]);
    }

    public function testTranslationsDescriptionValidation(): void
    {
        $this->post(route($this->route), [
            'translations' => [
                [
                    'description' => '',
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.description',
            ]);

        $this->post(route($this->route), [
            'translations' => [
                0 => [
                    'description' => str_repeat('a', 2),
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.description',
            ]);

        $this->post(route($this->route), [
            'translations' => [
                [
                    'description' => str_repeat('a', 65536),
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.description',
            ]);

        $this->post(route($this->route), [
            'translations' => [
                [
                    'description' => [],
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.description',
            ]);
    }

    public function testTranslationsContentValidation(): void
    {
        $this->post(route($this->route), [
            'translations' => [
                [
                    'content' => '',
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.content',
            ]);

        $this->post(route($this->route), [
            'translations' => [
                0 => [
                    'content' => str_repeat('a', 2),
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.content',
            ]);

        $this->post(route($this->route), [
            'translations' => [
                [
                    'content' => [],
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.content',
            ]);
    }

    public function testTranslationsLanguageIdValidation(): void
    {
        $this->post(route($this->route), [
            'translations' => [
                [
                    'language_id' => '',
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.language_id',
            ]);

        $this->post(route($this->route), [
            'translations' => [
                0 => [
                    'language_id' => str_repeat('a', 2),
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.language_id',
            ]);

        $this->post(route($this->route), [
            'translations' => [
                [
                    'language_id' => Str::orderedUuid(),
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations.0.language_id',
            ]);

        $language = Language::factory()->create();

        $this->post(route($this->route), [
            'translations' => [
                [
                    'language_id' => (string) $language->id,
                ],
            ],
        ])
            ->assertStatus(422)
            ->assertJsonMissingValidationErrors([
                'translations.0.language_id',
            ]);
    }

    public function testSuccessResponse(): void
    {
        $languages = Language::factory(2)->create();
        $tags = Tag::factory(5)->create();
        $translations = collect();
        $languages->each(static fn (Language $language) => $translations->push(PostTranslation::factory()->make(['language_id' => $language->id])));

        $response = $this->post(route($this->route), [
            'translations' => $translations->toArray(),
            'tags'         => $tags->map(static fn (Tag $tag) => (string) $tag->id)->toArray(),
        ]);
        $response->assertStatus(201);
        $json = $response->json('data');
        $translation = $translations->first();

        $this->assertDatabaseHas(Post::class, [
            'id' => $json['id'],
        ]);
        $this->assertDatabaseHas(PostTranslation::class, [
            'post_id'     => $json['id'],
            'language_id' => $translation->language_id,
            'title'       => $translation->title,
            'description' => $translation->description,
            'content'     => $translation->content,
        ]);
        $this->assertDatabaseHas('post_tag', [
            'post_id' => $json['id'],
            'tag_id'  => $tags->first()->id,
        ]);
    }
}
