<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\FineRule;

class Loan extends Model
{
    protected $fillable = ['user_id', 'book_id', 'loan_date', 'return_date', 'fine_amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function calculateFine()
    {
        $fineRule = FineRule::first();
        if (!$fineRule) return 0.00;

        $dueDate = Carbon::parse($this->loan_date)->addDays($fineRule->max_days);
        $endDate = $this->return_date ? Carbon::parse($this->return_date) : Carbon::now();

        if ($endDate->gt($dueDate)) {
            $overdueDays = $dueDate->diffInDays($endDate);
            return $overdueDays * $fineRule->amount_per_day;
        }

        return 0.00;
    }
}
