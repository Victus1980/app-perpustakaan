<?php

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('shows the logged-in user as the loan clerk without a manual user selector', function () {
    $user = User::create([
        'nama' => 'Petugas Uji',
        'email' => 'petugas@example.test',
        'password' => Hash::make('password'),
        'role' => 'petugas',
    ]);

    $response = $this->actingAs($user)->get(route('loans.create'));

    $response->assertSee('Petugas pencatat: Petugas Uji', false);
    $response->assertDontSee('name="user_id"', false);
});

it('stores the loan date when a logged-in user creates a loan', function () {
    $user = User::create([
        'nama' => 'Petugas Uji',
        'email' => 'petugas@example.test',
        'password' => Hash::make('password'),
        'role' => 'petugas',
    ]);
    $member = Member::create([
        'nama' => 'Anggota Uji',
        'nim' => '123456',
        'email' => 'anggota@example.test',
        'nomor_telepon' => '08123456789',
        'alamat' => 'Alamat Uji',
        'status' => 'aktif',
    ]);
    $category = Category::create(['nama_kategori' => 'Kategori Uji']);
    $book = Book::create([
        'judul' => 'Buku Uji',
        'penulis' => 'Penulis Uji',
        'penerbit' => 'Penerbit Uji',
        'tahun_terbit' => 2026,
        'stok' => 1,
        'category_id' => $category->id,
    ]);

    $response = $this->actingAs($user)->post(route('loans.store'), [
        'member_id' => $member->id,
        'tanggal_pinjam' => '2026-10-08',
        'tanggal_kembali' => '2026-10-15',
        'book_ids' => [$book->id],
    ]);

    $response->assertRedirect(route('loans.index'));
    $this->assertDatabaseHas('loans', [
        'member_id' => $member->id,
        'user_id' => $user->id,
        'tanggal_pinjam' => '2026-10-08',
        'tanggal_kembali' => '2026-10-15',
    ]);
});
