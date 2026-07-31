<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('provider_id')->constrained('provider_profiles')->restrictOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('type', 30)->index();
            $table->string('name', 150);
            $table->string('slug', 170)->unique();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('pricing_unit', 30)->default('day');
            $table->decimal('price', 12, 2);
            $table->string('district', 100)->nullable()->index();
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('deposit_amount', 12, 2)->default(0);
            $table->boolean('is_featured')->default(false)->index();
            $table->string('status', 30)->default('active')->index();
            $table->timestamps();

            $table->index(['type', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
