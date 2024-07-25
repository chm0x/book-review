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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('book_id'); # FOREIGN KEY
            $table->text('review');
            $table->unsignedTinyInteger('rating');
            $table->timestamps();

            # FOREIGN KEY
            // $table->foreign('book_id')->references('id')->on('books')
            //         ->onDelete('cascade');

            # SHORT SYNTAX FOR FOREIGN KEY
            # The constrained method set up automaticallt the foreign key constraint.
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
