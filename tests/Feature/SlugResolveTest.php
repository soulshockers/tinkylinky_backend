<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SlugResolveTest extends TestCase
{
    use WithFaker;

    public function test_slug_can_be_resolved(): void
    {
        $user = User::factory()->hasUrls(1)->create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ]);

        $url = $user->urls->first();

        $response = $this->get(route('slug.resolve', $url->slug));

        $response->assertRedirect($url->url);
    }

    public function test_nonexistent_slug_returns_not_found(): void
    {
        $response = $this->get(route('slug.resolve', 'fake'));

        $response->assertNotFound();
    }
}
