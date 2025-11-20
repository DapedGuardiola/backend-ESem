<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_detail_table', function (Blueprint $table) {
            $table->id('event_detail_id');
            $table->unsignedBigInteger('event_id');
            $table->string('event_name');
            $table->integer('total_participant');
            $table->dateTime('date');
            $table->unsignedBigInteger('event_handler');
            $table->integer('cost');
            $table->integer('total_income');
            $table->boolean('paid_status');


            $table->foreign('event_id')
                ->references('event_id')
                ->on('event_table')
                ->onDelete('cascade');

            $table->foreign('event_handler')
                ->references('user_id')
                ->on('user_table')
                ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_detail_table');
    }
};
