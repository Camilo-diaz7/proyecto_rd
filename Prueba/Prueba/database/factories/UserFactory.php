<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'tipo_documento' => 'CC',
            'numero_documento' => fake()->numerify('#########'),
            'role' => fake()->randomElement(['admin', 'empleado', 'cliente']),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // contraseña fija "password"
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
