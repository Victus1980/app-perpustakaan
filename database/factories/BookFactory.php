<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Category;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => fake()->title(),
            'penulis' => fake()->name(),
            'penerbit' => fake()->company(),
            'tahun_terbit' => fake()->year(),
            'isbn' => fake()->isbn13(),
            'stok' => fake()->numberBetween(1, 10),
            'sampul' => fake()->url(),
            'category_id' => Category::factory(),
        ];
    }
}
