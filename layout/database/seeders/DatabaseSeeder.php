<?php

namespace Database\Seeders;

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
        $this->call([
            StaffSeeder::class,
            CampaignSeeder::class,
            UserSeeder::class,
            EntrySeeder::class,
            ProductSeeder::class,
            DailySummarySeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
