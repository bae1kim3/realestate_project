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
        Schema::create('jjims', function (Blueprint $table) {
            $table->unsignedInteger('s_no');
            $table->unsignedBigInteger('id');

            $table->foreign('s_no')->references('s_no')->on('s_infos');
            $table->foreign('id')->references('id')->on('users');
            $table->primary(['s_no', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jjims');
    }
};
