<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('redirects guests away from the profile page', function () {
    $response = $this->get(route('profile.show'));

    $response->assertRedirect(route('login'));
});

it('shows the authenticated user profile and navbar link', function () {
    $user = User::create([
        'nama' => 'Petugas Profil',
        'email' => 'profil@example.test',
        'password' => Hash::make('password-lama'),
        'role' => 'petugas',
    ]);

    $response = $this->actingAs($user)->get(route('profile.show'));

    $response->assertSee('Petugas Profil');
    $response->assertSee('profil@example.test');
    $response->assertSee('Petugas');
    $response->assertSee('href="'.route('profile.show').'"', false);
    $response->assertSee('name="current_password"', false);
    $response->assertSee('name="password_confirmation"', false);
});

it('rejects a password change when the old password is incorrect', function () {
    $user = User::create([
        'nama' => 'Petugas Profil',
        'email' => 'profil@example.test',
        'password' => Hash::make('password-lama'),
        'role' => 'petugas',
    ]);

    $response = $this->actingAs($user)->post(route('profile.password.update'), [
        'current_password' => 'password-salah',
        'password' => 'password-baru',
        'password_confirmation' => 'password-baru',
    ]);

    $response->assertSessionHasErrors('current_password');
    expect(Hash::check('password-lama', $user->fresh()->password))->toBeTrue();
});

it('requires a new password of at least eight characters', function () {
    $user = User::create([
        'nama' => 'Petugas Profil',
        'email' => 'profil@example.test',
        'password' => Hash::make('password-lama'),
        'role' => 'petugas',
    ]);

    $response = $this->actingAs($user)->post(route('profile.password.update'), [
        'current_password' => 'password-lama',
        'password' => 'short',
        'password_confirmation' => 'short',
    ]);

    $response->assertSessionHasErrors('password');
    expect(Hash::check('password-lama', $user->fresh()->password))->toBeTrue();
});

it('requires matching new password confirmation', function () {
    $user = User::create([
        'nama' => 'Petugas Profil',
        'email' => 'profil@example.test',
        'password' => Hash::make('password-lama'),
        'role' => 'petugas',
    ]);

    $response = $this->actingAs($user)->post(route('profile.password.update'), [
        'current_password' => 'password-lama',
        'password' => 'password-baru',
        'password_confirmation' => 'password-berbeda',
    ]);

    $response->assertSessionHasErrors('password');
    expect(Hash::check('password-lama', $user->fresh()->password))->toBeTrue();
});

it('stores a valid new password as a hash', function () {
    $user = User::create([
        'nama' => 'Petugas Profil',
        'email' => 'profil@example.test',
        'password' => Hash::make('password-lama'),
        'role' => 'petugas',
    ]);

    $response = $this->actingAs($user)->post(route('profile.password.update'), [
        'current_password' => 'password-lama',
        'password' => 'password-baru',
        'password_confirmation' => 'password-baru',
    ]);

    $response->assertRedirect(route('profile.show'));
    $response->assertSessionHas('success', 'Password berhasil diperbarui.');
    expect(Hash::check('password-baru', $user->fresh()->password))->toBeTrue();
    expect($user->fresh()->password)->not->toBe('password-baru');
});
