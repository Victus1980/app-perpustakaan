<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('seeds users with the names column defined by the migration', function () {
    $this->seed();

    $this->assertDatabaseHas('users', [
        'email' => 'admin@pens.ac.id',
        'nama' => 'admin Perpustakaan',
        'role' => 'admin',
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'petugas1@pens.ac.id',
        'nama' => 'petugas 1',
        'role' => 'petugas',
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'petugas2@pens.ac.id',
        'nama' => 'petugas 2',
        'role' => 'petugas',
    ]);
});
