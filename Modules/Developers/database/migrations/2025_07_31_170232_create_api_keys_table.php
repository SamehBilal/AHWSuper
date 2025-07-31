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
       Schema::create('developers.api_keys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id');
            $table->string('name');
            $table->string('key')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_used_at')->nullable();
            $table->integer('rate_limit')->default(1000); // requests per hour
            $table->json('allowed_ips')->nullable();
            $table->json('allowed_scopes')->nullable();
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('developers.apps')->onDelete('cascade');
            $table->index(['key', 'is_active']);
            $table->index('app_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developers.api_keys');
    }
};
