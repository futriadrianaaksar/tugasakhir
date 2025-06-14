<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixLoansLoanDateColumn extends Migration
{
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->date('loan_date')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->string('loan_date')->nullable()->change();
        });
    }
}

