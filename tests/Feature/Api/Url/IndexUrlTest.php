<?php

namespace Tests\Feature\Api\Url;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexUrlTest extends TestCase
{
    use WithFaker;

    public function test_user_can_index_their_own_urls(): void
    {
        $user = User::factory()->hasUrls(30)->create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ]);

        $response = $this->actingAs($user)->getJson(route('urls.index'));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'url',
                        'slug',
                        'created_at',
                        'updated_at',
                    ]
                ],
                'links',
                'meta'
            ])
            ->assertJson([
                'meta' => ['total' => 30]
            ]);
    }

    public function test_user_cannot_index_urls_they_do_not_own(): void
    {
        User::factory()->hasUrls(30)->create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ]);

        $user = User::factory()->create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ]);

        $response = $this->actingAs($user)->getJson(route('urls.index'));

        $response->assertOk()
            ->assertJson([
                'meta' => ['total' => 0]
            ]);
    }
}
