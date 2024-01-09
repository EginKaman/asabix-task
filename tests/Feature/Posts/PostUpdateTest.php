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
final class PostUpdateTest extends TestCase
{
    use RefreshDatabase;

    private string $route = 'api.posts.update';

    public function testBasic(): void
    {
        $post = Post::factory()->create();

        $response = $this->options(route($this->route, $post));

        $response->assertHeader('allow', 'GET,HEAD,PUT,PATCH,DELETE');
    }

    public function testNotFoundTag(): void
    {
        $post = Post::factory()->make();

        $response = $this->put(route($this->route, $post));

        $response->assertStatus(404);
    }

    public function testTranslationsValidation(): void
    {
        $post = Post::factory()->create();

        $this->put(route($this->route, $post))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations',
            ]);

        $this->put(route($this->route, $post), [
            'translations' => 'asdf',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations',
            ]);

        $this->put(route($this->route, $post), [
            'translations' => [],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'translations',
            ]);
    }

    public function testTranslationsTitleValidation(): void
    {
        $post = Post::factory()->create();

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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
        $post = Post::factory()->create();

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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
        $post = Post::factory()->create();

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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
        $post = Post::factory()->create();

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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

        $this->put(route($this->route, $post), [
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
        $post = Post::factory()->create();
        $languages = Language::factory(2)->create();
        $tags = Tag::factory(5)->create();
        $translations = collect();
        $languages->each(static fn (Language $language) => PostTranslation::factory()->create(['language_id' => $language->id, 'post_id' => $post->id]));
        $languages->each(static fn (Language $language) => $translations->push(PostTranslation::factory()->make(['language_id' => $language->id])));

        $response = $this->put(route($this->route, $post), [
            'translations' => $translations->toArray(),
            'tags'         => $tags->map(static fn (Tag $tag) => (string) $tag->id)->toArray(),
        ]);
        $response->assertStatus(200);
        $translation = $translations->first();

        $this->assertDatabaseHas(Post::class, [
            'id' => $post->id,
        ]);
        $this->assertDatabaseHas(PostTranslation::class, [
            'post_id'     => $post->id,
            'language_id' => (string) $translation->language_id,
            'title'       => $translation->title,
            'description' => $translation->description,
            'content'     => $translation->content,
        ]);
        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id'  => $tags->first()->id,
        ]);
    }
}
