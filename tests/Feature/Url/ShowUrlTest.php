<?php

namespace Tests\Feature\Url;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowUrlTest extends TestCase
{
    use WithFaker;

    public function test_user_can_show_their_own_url(): void
    {
        $user = User::factory()->hasUrls(1)->create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ]);

        $url = $user->urls->first();

        $response = $this->actingAs($user)->getJson(route('urls.show', $url->id));

        $response->assertOk()->assertJsonStructure([
                'data' =>  [
                    'id',
                    'url',
                    'slug',
                    'created_at',
                    'updated_at'
                ],
            ]);
    }

    public function test_user_cannot_show_urls_they_do_not_own(): void
    {
        $user = User::factory()->create();

        $url = User::factory()->hasUrls(1)->create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ])->urls->first();

        $response = $this->actingAs($user)->getJson(route('urls.destroy', $url->id));

        $response->assertNotFound();
    }
}
