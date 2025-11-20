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
        Schema::create('registered_table', function (Blueprint $table) {
            $table->id('registered_id')->unique()->autoIncrement();
            $table->unsignedBigInteger('event_id');
            $table->string('registered_name');
            $table->string('registered_email');
            $table->string('registered_phone');
            $table->boolean('payment_status');

            $table->foreign('event_id')
                ->references('event_id')
                ->on('event_table')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registered_table');
    }
};
