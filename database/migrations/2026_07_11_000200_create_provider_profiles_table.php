<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_profiles', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('provider_type', 40)->index();
            $table->string('nic_or_registration_no', 100)->nullable();
            $table->string('district', 100)->index();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->string('verification_status', 30)->default('pending')->index();
            $table->string('availability_status', 30)->default('available')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_profiles');
    }
};
