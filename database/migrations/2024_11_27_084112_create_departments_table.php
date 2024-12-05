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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->Text('description')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('branch_id')->nullable(); // Add this if it doesn't exist
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            if (!Schema::hasColumn('departments', 'branch_id')) {
                $table->unsignedBigInteger('branch_id')->nullable();
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
