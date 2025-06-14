<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFineRulesTable extends Migration
{
    public function up()
    {
        Schema::create('fine_rules', function (Blueprint $table) {
            $table->id();
            $table->integer('fine_per_day')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fine_rules');
    }
}
