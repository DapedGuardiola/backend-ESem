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
        Schema::create('session_table', function (Blueprint $table) {
            $table->id('session_id')->unique()->autoIncrement();
            $table->string('session_name');
            $table->unsignedBigInteger('event_id');

            $table->foreign('event_id')->references('event_id')->on('event_table')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_table');
    }
};
