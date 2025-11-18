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
        Schema::create('user_detail_table', function (Blueprint $table) {
            $table->id('user_detail_id');
            $table->unsignedBigInteger('user_id');
            $table->string('user_name');
            $table->string('address');
            $table->string('user_phone')->unique();
            $table->string('user_status');

            $table->foreign('user_id')
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
        Schema::dropIfExists('user_detail_table');
    }
};
