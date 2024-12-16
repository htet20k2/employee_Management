<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_detail_id'); 
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('rank_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->foreign('employee_detail_id')->references('id')->on('employee_details')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
