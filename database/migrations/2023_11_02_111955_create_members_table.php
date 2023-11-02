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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('membership_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('maritalstatus_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('prayercell_id');
            $table->unsignedBigInteger('membershiptype_id');
            $table->enum('sex', ['Male', 'Female']);
            $table->string('birthdate')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('join_date');
            $table->string('photo');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('maritalstatus_id')->references('id')->on('maritalstatuses')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('prayercell_id')->references('id')->on('prayercells')->onDelete('cascade');
            $table->foreign('membershiptype_id')->references('id')->on('membershiptypes')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
