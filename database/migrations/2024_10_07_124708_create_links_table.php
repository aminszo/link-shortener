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
        Schema::create('links', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->timestamps(); // created_at and updated_at
            $table->string('slug')->unique(); // Shortened link (unique)
            $table->string("destination", 2048); // Full destination URL (limited to 2048 characters)
            $table->string('title')->nullable(); // Title for the link (optional)
            $table->text('description')->nullable(); // Description for the link (optional)
            $table->unsignedBigInteger('visits_count')->default(0); // Number of visits
            $table->unsignedBigInteger('visits_limit')->nullable(); // optional limit for visits count
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key to the user, with cascade delete
            $table->timestamp('expires_at')->nullable(); // Optional expiration date for the link
            $table->timestamp('last_visited_at')->nullable(); // Track the last time the link was visited

            // Add indexes for performance
            $table->index('user_id'); // Index on user_id for faster lookups
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
