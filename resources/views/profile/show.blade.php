@extends('layouts.app')

@section('title', 'Profil Petugas')

@section('content')
    <h1>Profil Petugas</h1>

    <dl>
        <dt>Nama</dt>
        <dd>{{ auth()->user()->nama }}</dd>

        <dt>Email</dt>
        <dd>{{ auth()->user()->email }}</dd>

        <dt>Role</dt>
        <dd>{{ ucfirst(auth()->user()->role) }}</dd>
    </dl>

    <h2>Ganti Password</h2>

    <form action="{{ route('profile.password.update') }}" method="POST">
        @csrf

        <label for="current_password">Password lama</label>
        <input type="password" name="current_password" id="current_password" required>
        @error('current_password')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password">Password baru</label>
        <input type="password" name="password" id="password" required minlength="8">
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password_confirmation">Konfirmasi password baru</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8">

        <button type="submit" class="btn">Simpan Password</button>
    </form>
@endsection
