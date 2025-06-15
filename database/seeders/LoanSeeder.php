<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use App\Models\FineRule;
use Carbon\Carbon;

class LoanSeeder extends Seeder
{
    public function run()
    {
        $mahasiswa1 = User::where('email', 'mahasiswa1@example.com')->first();
        $mahasiswa2 = User::where('email', 'mahasiswa2@example.com')->first();
        $book = Book::first();
        $fineRule = FineRule::first();

        if ($mahasiswa1 && $book && $fineRule) {
            Loan::create([
                'user_id' => $mahasiswa1->id,
                'book_id' => $book->id,
                'loan_date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'status' => 'dipinjam',
                'fine_amount' => $this->calculateFine(Carbon::now()->subDays(10), null, $fineRule),
            ]);
        }

        if ($mahasiswa2 && $book && $fineRule) {
            Loan::create([
                'user_id' => $mahasiswa2->id,
                'book_id' => $book->id,
                'loan_date' => Carbon::now()->subDays(12)->format('Y-m-d'),
                'return_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'status' => 'dikembalikan',
                'fine_amount' => $this->calculateFine(Carbon::now()->subDays(12), Carbon::now()->subDays(2), $fineRule),
            ]);
        }
    }

    private function calculateFine($loanDate, $returnDate, $fineRule)
    {
        $dueDate = Carbon::parse($loanDate)->addDays($fineRule->max_days);
        $endDate = $returnDate ? Carbon::parse($returnDate) : Carbon::now();

        if ($endDate->gt($dueDate)) {
            $overdueDays = $dueDate->diffInDays($endDate);
            return $overdueDays * $fineRule->amount_per_day;
        }

        return 0.00;
    }
}
