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
final class TagDeleteTest extends TestCase
{
    use RefreshDatabase;

    private string $route = 'api.tags.destroy';

    public function testBasic(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->options(route($this->route, $tag));

        $response->assertHeader('allow', 'GET,HEAD,PUT,PATCH,DELETE');
    }

    public function testNotFoundTag(): void
    {
        $tag = Tag::factory()->make();

        $response = $this->delete(route($this->route, $tag));

        $response->assertStatus(404);
    }

    public function testSuccess(): void
    {
        $tag = Tag::factory()->create();

        $response = $this->delete(route($this->route, $tag));

        $response->assertStatus(204);

        $this->assertSoftDeleted(Tag::class, [
            'id' => $tag->id,
        ]);
    }
}
