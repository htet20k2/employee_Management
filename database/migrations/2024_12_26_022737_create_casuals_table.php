<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('casuals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable(false);
            $table->integer('formonth');
            $table->integer('foryear');
            $table->integer('count');
            $table->boolean('isTraining')->default(false);
            $table->timestamps();
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casuals');
    }
};
