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
final class TagIndexTest extends TestCase
{
    use RefreshDatabase;

    private string $route = 'api.tags.index';

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
                    'name',
                    'created_at',
                    'updated_at',
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
        Tag::factory(60)->create();

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
            'page' => 10,
        ]))->assertStatus(200)
            ->assertJsonCount(0, 'data');

        $this->get(route($this->route, [
            'page' => 'test',
        ]))->assertStatus(200);
    }
}
