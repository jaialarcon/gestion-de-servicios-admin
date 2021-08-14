<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Category;
use App\Models\Request;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        Category::factory(20)->has(Service::factory()->count(5))->create();
        User::factory(20)->create()->each(function ($user) {
            $requets = Request::factory([
                'user_id' => $user->id,
                'service_id' => Service::inRandomOrder()->first()->id,
                'category_id' => Category::inRandomOrder()->first()->id,
            ])->count(5)->create();

            // Create bids for requests
            $requets->each(function ($requet) {
                Bid::factory([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'request_id' => $requet->id
                ])->count(rand(2, 5))->create();
            });
        });
    }
}
