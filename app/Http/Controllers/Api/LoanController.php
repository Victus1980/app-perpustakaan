<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoanResource;
use App\Models\Loan;
use App\Models\LoanItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member', 'user', 'loanItems.book'])->get();
        return LoanResource::collection($loans);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'user_id' => 'required|exists:users,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'books' => 'required|array|min:1',
            'books.*' => 'exists:books,id',
        ]);

        $loan = Loan::create([
            'member_id' => $validated['member_id'],
            'user_id' => $validated['user_id'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => 'dipinjam',
        ]);

        foreach ($validated['books'] as $bookId) {
            LoanItem::create([
                'loan_id' => $loan->id,
                'book_id' => $bookId,
            ]);
        }

        $loan->load(['member', 'user', 'loanItems.book']);

        return response()->json(new LoanResource($loan), Response::HTTP_CREATED);
    }

    public function kembalikan(Request $request, $id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json([
                'message' => 'Loan not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $loan->update([
            'tanggal_dikembalikan' => now(),
            'status' => 'dikembalikan',
        ]);

        $loan->load(['member', 'user', 'loanItems.book']);

        return new LoanResource($loan);
    }
}
