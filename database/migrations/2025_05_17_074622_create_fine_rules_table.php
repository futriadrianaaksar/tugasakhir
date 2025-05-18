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
                 $table->integer('amount');
                 $table->text('description')->nullable();
                 $table->timestamps();
             });
         }

         public function down()
         {
             Schema::dropIfExists('fine_rules');
         }
     }
