@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('content')
    <h1>Laporan Peminjaman</h1>
    <p>Data diambil dari <code>GET /api/loans</code> menggunakan Laravel HTTP Client.</p>

    @if ($apiError)
        <div class="alert-success" style="background:#fee2e2;color:#991b1b;">{{ $apiError }}</div>
    @endif

    @if ($loans->isEmpty() && ! $apiError)
        <p>Belum ada data peminjaman.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Anggota</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Buku</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <td>{{ $loan['id'] ?? '-' }}</td>
                        <td>{{ $loan['member']['nama'] ?? '-' }}</td>
                        <td>{{ $loan['tanggal_pinjam'] ?? '-' }}</td>
                        <td>{{ $loan['tanggal_kembali'] ?? '-' }}</td>
                        <td>{{ $loan['status'] ?? '-' }}</td>
                        <td>
                            @foreach ($loan['books'] ?? [] as $book)
                                <div>{{ $book['judul'] ?? ($book['pivot']['judul'] ?? '-') }}</div>
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">Belum ada data peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    @endif

    <p style="margin-top: 24px;"><a href="{{ route('dashboard') }}" class="btn">Kembali ke Dashboard</a></p>
@endsection
