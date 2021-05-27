<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


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
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'role' => 'user',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function senior()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'senior',
                'email' => 'senior@test.ru',
                'role' => 'senior',
            ];
        });
    }
    public function junior()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'junior',
                'email' => 'junior@test.ru',
                'role' => 'junior',
            ];
        });
    }
    public function user()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'user',
                'email' => 'user@test.ru',
                'role' => 'user',
            ];
        });
    }
}
