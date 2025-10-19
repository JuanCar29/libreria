<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Libro>
 */
class LibroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'autor' => $this->faker->name(),
            'anio_publicacion' => $this->faker->year(),
            'isbn' => $this->faker->unique()->isbn13(),
            'genero_id' => \App\Models\Genero::inRandomOrder()->first()?->id,
        ];
    }
}
