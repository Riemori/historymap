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
        Schema::create('local_details', function (Blueprint $table) {
            $table->uuid('localid');
            $table->foreign('localid')->references('id')->on('locals')->onDelete('cascade');
            $table->string('Photo2')->nullable();
            $table->string('Photo3')->nullable();
            $table->text('Summary')->nullable();
            $table->string('url')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_details');
    }
};
