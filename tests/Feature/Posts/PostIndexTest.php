<?php

declare(strict_types=1);

namespace Posts;

use Database\Seeders\LanguageSeeder;
use Database\Seeders\PostSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 *
 * @small
 */
final class PostIndexTest extends TestCase
{
    use RefreshDatabase;

    private string $route = 'api.posts.index';

    public function testBasic(): void
    {
        $response = $this->get(route($this->route));

        $response->assertHeader('Content-Type', 'application/json')
            ->assertStatus(200);
    }

    public function testSchema(): void
    {
        $response = $this->get(route($this->route));

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'content',
                    'created_at',
                    'updated_at',
                    'tags' => [
                        '*' => [
                            'id',
                            'name',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ],
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'links' => [
                    '*' => [
                        'url',
                        'label',
                        'active',
                    ],
                ],
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);
    }

    public function testPagination(): void
    {
        (new LanguageSeeder())->run();
        (new PostSeeder())->run();

        $response = $this->get(route($this->route));
        $response->assertStatus(200);

        $json = $response->json();

        $lastPage = $json['meta']['last_page'];

        for ($page = 1; $page <= $lastPage; ++$page) {
            $this->get(route($this->route, [
                'page' => $page,
            ]))
                ->assertStatus(200)
                ->assertJsonCount(15, 'data');
        }

        $this->get(route($this->route, [
            'page' => $lastPage + 1,
        ]))->assertStatus(200)
            ->assertJsonCount(0, 'data');

        $this->get(route($this->route, [
            'page' => 'test',
        ]))->assertStatus(200);
    }
}
