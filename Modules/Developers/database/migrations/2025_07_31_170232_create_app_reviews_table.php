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
       Schema::create('developers.app_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('rating'); // 1-5 stars
            $table->text('comment')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('developers.apps')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('public.users')->onDelete('cascade');

            $table->unique(['app_id', 'user_id']); // One review per user per app
            $table->index(['app_id', 'rating']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developers.app_reviews');
    }
};
