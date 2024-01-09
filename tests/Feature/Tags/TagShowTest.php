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
final class TagShowTest extends TestCase
{
    use RefreshDatabase;

    private string $route = 'api.tags.show';

    public function testBasic(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->get(route($this->route, $tag));

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                ],
            ]);
    }

    public function testNotFoundTag(): void
    {
        $tag = Tag::factory()->make();

        $response = $this->get(route($this->route, $tag));

        $response->assertStatus(404);
    }

    public function testSuccessResponse(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->get(route($this->route, $tag));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    'id'         => $tag->id,
                    'name'       => $tag->name,
                    'created_at' => $tag->created_at,
                    'updated_at' => $tag->updated_at,
                ],
            ]);
    }
}
