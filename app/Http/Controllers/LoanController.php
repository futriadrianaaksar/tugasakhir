<?php
namespace App\Http\Controllers;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'mahasiswa') {
            $loans = Loan::where('user_id', Auth::id())->paginate(10);
        } else {
            $loans = Loan::paginate(10);
        }
        return view('loans.index', compact('loans'));
    }

    public function return(Request $request, $loan_id)
    {
        $loan = Loan::findOrFail($loan_id);
        $loan->status = 'dikembalikan';

        // Asumsi due_date ada, default 7 hari jika null
        $loan->due_date = $loan->due_date ?? Carbon::parse($loan->loan_date)->addDays(7);
        $loan->return_date = Carbon::today();

        $daysLate = $loan->return_date->diffInDays($loan->due_date, false);
        if ($daysLate > 0) {
            $fineRule = \App\Models\FineRule::first();
            $loan->fine = $daysLate * ($fineRule ? $fineRule->amount_per_day : 0);
        }

        $loan->save();
        $loan->book->increment('stock');

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dikembalikan.');
    }
}

