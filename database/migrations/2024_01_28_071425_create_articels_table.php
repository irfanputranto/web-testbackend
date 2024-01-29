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
        Schema::create('articels', function (Blueprint $table) {
            $table->id();
            $table->string('alias')->uniqid();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('publish_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articels');
    }
};
