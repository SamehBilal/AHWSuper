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
        Schema::create('developers.tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('ticket_number', 20)->unique();
            $table->string('title');
            $table->enum('category', [
                'api',
                'authentication',
                'documentation',
                'sdk',
                'performance',
                'billing',
                'feature_request',
                'other'
            ]);
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');
            $table->text('description');
            $table->text('steps_to_reproduce')->nullable();
            $table->text('expected_behavior')->nullable();
            $table->text('actual_behavior')->nullable();
            $table->text('environment_details')->nullable();
            $table->string('api_endpoint')->nullable();
            $table->text('error_message')->nullable();
            $table->string('contact_email');
            $table->json('attachments')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->text('admin_notes')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('ticket_number');
            $table->index(['status', 'priority']);
            $table->index(['category', 'status']);
            $table->index('created_at');

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developers.tickets');
    }
};
