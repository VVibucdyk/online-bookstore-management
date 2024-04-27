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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('genre_id');
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->unique();
            $table->string('publisher');
            $table->unsignedSmallInteger('publication_year');
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->decimal('price', 8, 2);
            $table->unsignedInteger('quantity')->default(0);
            $table->decimal('discount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
