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
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('branch_id');         
            $table->unsignedBigInteger('department_id');         
            $table->unsignedBigInteger('duty_time_id');         
            $table->unsignedBigInteger('rank_id');   
            $table->string('enroll_date')->nullable();
            $table->boolean('isTraining')->default(false);
            $table->string('permanent_date')->nullable();
            $table->string('emp_photos', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_details');
    }
};