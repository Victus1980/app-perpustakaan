<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggal_pinjam = fake()->dateTimeBetween('-30 days', 'now');
        $tanggal_kembali = (clone $tanggal_pinjam)->modify('+7 days');

        return [
            'member_id' => Member::factory(),
            'user_id' => User::factory(),
            'tanggal_pinjam' => $tanggal_pinjam->format('Y-m-d'),
            'tanggal_kembali' => $tanggal_kembali->format('Y-m-d'),
            'status' => fake()->randomElement(['dipinjam', 'dikembalikan', 'terlambat']),
        ];
    }
}
