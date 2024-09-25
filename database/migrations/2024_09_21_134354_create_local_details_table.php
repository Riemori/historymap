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
            $table->id();
            $table->foreignUuid('local_id')
                ->references('id')
                ->on('locals')
                ->onDelete('cascade');
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
            $table->text('summary')->nullable();
            $table->string('url')->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('update_date')->nullable();
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
