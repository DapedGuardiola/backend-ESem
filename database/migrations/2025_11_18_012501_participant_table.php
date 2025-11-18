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
        Schema::create('participant_table', function (Blueprint $table) {
            $table->id('participant_id')->unique()->autoIncrement();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('registered_id'); 

            $table->foreign('event_id')
            ->references('event_id')
            ->on('event_table')
            ->onDelete('cascade');

            $table->foreign('session_id')
            ->references('session_id')
            ->on('session_table')
            ->onDelete('cascade');

            $table->foreign('registered_id')
            ->references('registered_id')
            ->on('registered_table')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant_table');
    }
};
