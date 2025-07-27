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
        Schema::create('developers.apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('website_url')->nullable();
            $table->string('callback_url');
            $table->json('redirect_uris');
            $table->string('logo_url')->nullable();
            $table->json('screenshots')->nullable();
            $table->enum('status', ['pending', 'approved', 'suspended', 'rejected'])->default('pending');
            $table->enum('type', ['web', 'mobile', 'desktop', 'api'])->default('web');
            $table->json('scopes')->nullable(); // Requested scopes
            $table->boolean('is_public')->default(true);
            $table->integer('downloads')->default(0);
            $table->decimal('rating', 2, 1)->nullable();
            $table->foreignId('developer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('oauth_client_id')->nullable()->constrained('oauth_clients')->onDelete('set null');
            $table->timestamps();

            $table->index(['status', 'is_public']);
            $table->index('developer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developers.apps');
    }
};
