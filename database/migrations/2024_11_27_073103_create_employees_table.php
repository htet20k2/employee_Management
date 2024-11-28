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
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('name');
            $table->string('phone', 20);
            $table->string('email')->unique();
            $table->date('DOB');
            $table->enum('sex', ['Male', 'Female', 'Other']);
            $table->string('NRC')->unique();
            $table->text('address');
            $table->string('township', 100);
       
            $table->enum('martial_status', ['Single', 'Married', 'Divorced']);
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();

            $table->string('race')->nullable();
            $table->string('religious')->nullable();
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
 
            $table->string('education');
            $table->string('other_qualification');
            $table->text('description')->nullable();
            $table->enum('status', ['Active', 'Inactive', 'On Leave', 'Terminated', 'Suspended'])->default('Active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
