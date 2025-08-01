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
       Schema::create('developers.webhooks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id');
            $table->string('name');
            $table->string('url');
            $table->json('events'); // ['user.login', 'user.profile.update', etc.]
            $table->string('secret')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('max_retries')->default(3);
            $table->timestamp('last_triggered_at')->nullable();
            $table->timestamps();

            $table->foreign('app_id')->references('id')->on('developers.apps')->onDelete('cascade');
            $table->index(['app_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developers.webhooks');
    }
};
