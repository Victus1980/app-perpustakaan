<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;

class StatsController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $totalLoans = Loan::count();
        $loansActive = Loan::where('status', 'dipinjam')->count();

        return response()->json([
            'total_buku' => $totalBooks,
            'total_anggota' => $totalMembers,
            'total_peminjaman' => $totalLoans,
            'peminjaman_aktif' => $loansActive,
        ]);
    }
}
