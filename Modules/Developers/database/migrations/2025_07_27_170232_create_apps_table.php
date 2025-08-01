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
            $table->string('logo')->nullable();
            $table->json('screenshots')->nullable();
            $table->enum('status', ['pending', 'approved', 'suspended', 'rejected'])->default('pending');
            $table->enum('type', ['web', 'mobile', 'desktop', 'api'])->default('web');
            $table->json('scopes')->nullable();
            $table->boolean('is_public')->default(true);
            $table->integer('downloads')->default(0);
            $table->decimal('rating', 2, 1)->nullable();
            $table->unsignedBigInteger('developer_id');
            $table->uuid('oauth_client_id')->nullable();
            $table->string('version')->default('1.0.0');
            $table->string('license')->nullable();
            $table->text('terms_of_service')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->text('support_email')->nullable();

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('suspended_at')->nullable();

            $table->softDeletes(); // Enable soft deletes
            $table->timestamps();

            // Foreign key constraints to main schema
            $table->foreign('developer_id')->references('id')->on('public.users')->onDelete('cascade');
            $table->foreign('oauth_client_id')->references('id')->on('developers.oauth_clients')->onDelete('set null');

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
