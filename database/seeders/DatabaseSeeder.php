<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\LoanItem;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        // Pertemuan 10 — generate data untuk testing (jika belum ada):
        if (Category::count() === 0) {
            Category::factory(5)->create();
        }
        if (Book::count() === 0) {
            Book::factory(10)->create();
        }
        if (Member::count() === 0) {
            Member::factory(5)->create();
        }
        if (Loan::count() === 0) {
            Loan::factory(8)->create()->each(function (Loan $loan) {
                LoanItem::factory(fake()->numberBetween(1, 3))->create([
                    'loan_id' => $loan->id,
                ]);
            });
        }
    }
}
