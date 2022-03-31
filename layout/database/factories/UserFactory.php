<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genderList = [
            '1' => '男性',
            '2' => '女性',
            '3' => 'ノンバイナリー',
        ];
        $gender = $this->faker->numberBetween(1, 3);
        if ($gender == 2) {
            $firstName = $this->faker->firstNameFeMale();
        } else {
            $firstName = $this->faker->firstNameMale();
        }
        return [
            'email_address' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'last_name' => $this->faker->lastName(),
            'first_name' => $firstName,
            'last_name_kana' => 'dummy',
            'first_name_kana' => 'dummy',
            'gender' => $genderList[$gender],
            'age' => $this->faker->numberBetween(1, 99),
            'postal_code' => (string)$this->faker->postcode(),
            'prefecture' => $this->faker->prefecture(),
            'address' => 'dummy',
            'phone_number' => str_replace('-', '', $this->faker->phoneNumber()),
            'ip_address' => 'dummy',
            'user_agent' => 'dummy',
            'cookie_id' => 'dummy',
            'status' => 2,
        ];
    }

    // /**
    //  * Indicate that the model's email address should be unverified.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Factories\Factory
    //  */
    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }

    // /**
    //  * Indicate that the user should have a personal team.
    //  *
    //  * @return $this
    //  */
    // public function withPersonalTeam()
    // {
    //     if (! Features::hasTeamFeatures()) {
    //         return $this->state([]);
    //     }

    //     return $this->has(
    //         Team::factory()
    //             ->state(function (array $attributes, User $user) {
    //                 return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
    //             }),
    //         'ownedTeams'
    //     );
    // }
}
