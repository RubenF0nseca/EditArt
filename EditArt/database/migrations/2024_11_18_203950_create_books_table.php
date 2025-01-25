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
            $table->string('title', 255);
            $table->string('type', 255);
            $table->date('publicationDate');
            $table->integer('editionNumber');
            $table->string('isbn', 13)->unique();
            $table->integer('numberOfPages');
            $table->integer('stock');
            $table->string('language', 255);
            $table->string('CoverPicture')->nullable();
            $table->double('price');
            $table->text('description')->nullable();
            $table->softDeletes();
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
