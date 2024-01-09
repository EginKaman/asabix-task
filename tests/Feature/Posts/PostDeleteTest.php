<?php

declare(strict_types=1);

namespace Posts;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @small
 */
final class PostDeleteTest extends TestCase
{
    use RefreshDatabase;

    private string $route = 'api.posts.destroy';

    public function testBasic(): void
    {
        $post = Post::factory()->create();

        $response = $this->options(route($this->route, $post));

        $response->assertHeader('allow', 'GET,HEAD,PUT,PATCH,DELETE');
    }

    public function testNotFoundTag(): void
    {
        $post = Post::factory()->make();

        $response = $this->delete(route($this->route, $post));

        $response->assertStatus(404);
    }

    public function testSuccess(): void
    {
        $post = Post::factory()->create();

        $response = $this->delete(route($this->route, $post));

        $response->assertStatus(204);

        $this->assertSoftDeleted(Post::class, [
            'id' => $post->id,
        ]);
    }
}
