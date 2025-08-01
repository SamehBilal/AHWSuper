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
       Schema::create('developers.app_analytics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('endpoint')->nullable();
            $table->string('method', 10);
            $table->integer('status_code');
            $table->integer('response_time_ms');
            $table->string('ip_address', 45);
            $table->string('user_agent')->nullable();
            $table->json('request_data')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('app_id')->references('id')->on('developers.apps')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('public.users')->onDelete('set null');

            $table->index(['app_id', 'created_at']);
            $table->index(['app_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developers.app_analytics');
    }
};
