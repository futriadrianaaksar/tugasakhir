<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_id', 'book_id', 'loan_date', 'status'];
    protected $casts = [
        'loan_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
