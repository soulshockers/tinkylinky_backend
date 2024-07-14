<?php

namespace Tests\Feature\Url;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreUrlTest extends TestCase
{
    use WithFaker;

    public function test_user_can_create_url(): void
    {
        $user = User::factory()->create();

        $url = $this->faker->url();

        $response = $this->actingAs($user)->postJson(route('urls.store'), [
            'url' => $url,
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('urls', ['url' => $url]);
    }

    public function test_user_can_not_create_url_with_null_url_parameter(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('urls.store'), [
            'url' => null,
        ]);
        $response->assertUnprocessable();
    }

    public function test_user_can_not_create_url_with_incorrect_url_parameter(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('urls.store'), [
            'url' => 'test',
        ]);

        $response->assertUnprocessable();
    }

    public function test_user_can_not_create_url_without_url_parameter(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('urls.store'));

        $response->assertUnprocessable();
    }
}
