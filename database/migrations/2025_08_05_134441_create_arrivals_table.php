<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arrivals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('full_name');
            $table->string('passport_number');
            $table->string('nationality');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('photo_path');
            $table->string('phone_number');
            $table->string('email');
            $table->string('stay_address');
            $table->string('flight_number');
            $table->timestamp('arrival_date');
            $table->string('origin_city');
            $table->string('destination_city');
            $table->text('health_history')->nullable();
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('vaccine_certificate_path');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->uuid('approved_by_user_id')->nullable();
            $table->uuid('rejected_by_user_id')->nullable();
            $table->text('reject_reason')->nullable();
            $table->timestamps();

            $table->foreign('approved_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('rejected_by_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrivals');
    }
};
