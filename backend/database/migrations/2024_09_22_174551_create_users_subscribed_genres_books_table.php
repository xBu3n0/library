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
        Schema::create("users_subscribed_genres_books", function (
            Blueprint $table
        ) {
            $table->uuid("id")->primary();

            $table
                ->foreignUuid("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade");

            $table
                ->foreignUuid("genre_id")
                ->references("id")
                ->on("genres")
                ->onDelete("cascade");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("users_subscribed_genres_books");
    }
};
