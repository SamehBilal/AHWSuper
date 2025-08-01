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
        Schema::create('app_testers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('invited_by');
            $table->string('email');
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->string('invitation_token');
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('developers.apps')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('public.users')->onDelete('cascade');
            $table->foreign('invited_by')->references('id')->on('public.users')->onDelete('cascade');

            $table->unique(['app_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_testers');
    }
};
