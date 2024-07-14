<?php

namespace Tests\Feature\Url;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyUrl extends TestCase
{
    use WithFaker;

    public function test_user_can_destroy_their_own_url(): void
    {
        $user = User::factory()->hasUrls(1)->create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ]);

        $url = $user->urls->first();

        $response = $this->actingAs($user)->deleteJson(route('urls.destroy', $url->id));

        $response->assertNoContent();

        $this->assertDatabaseMissing('urls', ['id' => $url->id]);
    }

    public function test_user_cannot_destroy_urls_they_do_not_own(): void
    {
        $user = User::factory()->create();

        $url = User::factory()->hasUrls(1)->create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ])->urls->first();

        $response = $this->actingAs($user)->deleteJson(route('urls.destroy', $url->id));

        $response->assertNotFound();

        $this->assertDatabaseHas('urls', ['id' => $url->id]);
    }
}
