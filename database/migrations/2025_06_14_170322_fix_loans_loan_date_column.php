<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            if (!Schema::hasColumn('loans', 'return_date')) {
                $table->date('return_date')->nullable()->after('loan_date');
            }
            if (!Schema::hasColumn('loans', 'fine_amount')) {
                $table->decimal('fine_amount', 10, 2)->default(0.00)->after('return_date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            if (Schema::hasColumn('loans', 'return_date')) {
                $table->dropColumn('return_date');
            }
            if (Schema::hasColumn('loans', 'fine_amount')) {
                $table->dropColumn('fine_amount');
            }
        });
    }
};
