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
            $table->string('title');
            $table->string('type');
            $table->date('publicationDate');
            $table->integer('editionNumber');
            $table->string('isbn')->unique();
            $table->integer('numberOfPages');
            $table->integer('stock');
            $table->string('language');
            $table->string('CoverPicture')->nullable();
            $table->double('price');
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
