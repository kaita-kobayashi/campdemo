<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    private static $num = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $campaign = Campaign::all();
        return [
            'campaign_id' => $this->faker->numberBetween(1, $campaign->count()),
            'user_id' => function () {
                return self::$num++;
            },
            'answer' => '{}'
        ];
    }
}
