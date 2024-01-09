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
final class TagStoreTest extends TestCase
{
    use RefreshDatabase;

    private string $route = 'api.tags.store';

    public function testBasic(): void
    {
        $response = $this->options(route($this->route));

        $response->assertHeader('allow', 'GET,HEAD,POST');
    }

    public function testNameValidation(): void
    {
        $this->post(route($this->route))
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
            ]);

        $this->post(route($this->route), [
            'name' => str_repeat('a', 2),
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
            ]);

        $this->post(route($this->route), [
            'name' => str_repeat('a', 256),
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
            ]);
    }

    public function testSuccessResponse(): void
    {
        $this->post(route($this->route), [
            'name' => $name = str_repeat('a', 3),
        ])
            ->assertStatus(201);

        $this->assertDatabaseHas(Tag::class, [
            'name' => $name,
        ]);

        $this->post(route($this->route), [
            'name' => $name = str_repeat('a', 255),
        ])
            ->assertStatus(201);

        $this->assertDatabaseHas(Tag::class, [
            'name' => $name,
        ]);
    }
}
