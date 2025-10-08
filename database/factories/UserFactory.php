<?php

namespace Database\Factories;

use App\Enums\EmploymentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'       => Hash::make('password'),
            'phone_number'   => fake()->numerify('09########'),
            'gender'         => 'Female',
            'date_of_birth'  => fake()->dateTimeBetween('-50 years', '-18 years'),
            'department_id'  => 1,
            'manager_id'     => 1,
            'document_id'    => 1,
            'employment_type' => fake()->randomElement(EmploymentType::cases())->value,
            'applicant'      => 0,
            'status'         => 'Active',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
