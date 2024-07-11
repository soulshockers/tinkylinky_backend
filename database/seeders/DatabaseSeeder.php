<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**

     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->hasUrls(100)->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(9)->hasUrls(100)->create();
    }
}
