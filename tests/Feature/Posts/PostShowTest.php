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
final class PostShowTest extends TestCase
{
    use RefreshDatabase;

    private string $route = 'api.posts.show';

    public function testBasic(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route($this->route, $post));

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'description',
                    'content',
                    'tags' => [
                        '*' => [
                            'id',
                            'name',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ],
            ]);
    }

    public function testNotFoundTag(): void
    {
        $post = Post::factory()->make();

        $response = $this->get(route($this->route, $post));

        $response->assertStatus(404);
    }

    public function testSuccessResponse(): void
    {
        $post = Post::factory()->create();

        $response = $this->get(route($this->route, $post));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    'id'          => $post->id,
                    'title'       => null,
                    'description' => null,
                    'content'     => null,
                    'created_at'  => $post->created_at,
                    'updated_at'  => $post->updated_at,
                    'tags'        => [],
                ],
            ]);
    }
}
