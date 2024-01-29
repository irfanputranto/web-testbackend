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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('business_name')->nullable();
            $table->string('location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longtitude')->nullable();
            $table->string('term')->nullable();
            $table->integer('radius')->nullable();
            $table->longText('categories')->nullable();
            $table->string('locale')->nullable();
            $table->string('price')->nullable();
            $table->boolean('open_now')->nullable();
            $table->integer('open_at')->nullable();
            $table->longText('attributes')->nullable();
            $table->enum('sort_by', ['best_match', 'rating', 'review_count', 'distance'])->default('best_match')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
