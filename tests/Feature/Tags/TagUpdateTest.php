<?php

declare(strict_types=1);

namespace Tests\Feature\Tags;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @small
 */
final class TagUpdateTest extends TestCase
{
    use RefreshDatabase;

    private string $route = 'api.tags.update';

    public function testBasic(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->options(route($this->route, $tag));

        $response->assertHeader('allow', 'GET,HEAD,PUT,PATCH,DELETE');
    }

    public function testNotFoundTag(): void
    {
        $tag = Tag::factory()->make();

        $response = $this->put(route($this->route, $tag));

        $response->assertStatus(404);
    }

    public function testNameValidation(): void
    {
        $tag = Tag::factory()->create();

        $this->put(route($this->route, $tag))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
            ]);

        $this->put(route($this->route, $tag), [
            'name' => str_repeat('a', 2),
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
            ]);

        $this->put(route($this->route, $tag), [
            'name' => str_repeat('a', 256),
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
            ]);
    }

    public function testSuccessResponse(): void
    {
        $tag = Tag::factory()->create();

        $this->put(route($this->route, $tag), [
            'name' => $name = str_repeat('a', 3),
        ])
            ->assertStatus(200)
            ->assertJsonMissingValidationErrors([
                'name',
            ]);

        $this->assertDatabaseHas(Tag::class, [
            'id' => $tag->id,
            'name' => $name,
        ]);

        $this->put(route($this->route, $tag), [
            'name' => $name = str_repeat('a', 255),
        ])
            ->assertStatus(200)
            ->assertJsonMissingValidationErrors([
                'name',
            ]);

        $this->assertDatabaseHas(Tag::class, [
            'id' => $tag->id,
            'name' => $name,
        ]);
    }
}
