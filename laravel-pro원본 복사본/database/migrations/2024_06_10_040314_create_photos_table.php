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
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('p_no');
            $table->unsignedInteger('s_no')->nullable(); // 외래 키
            $table->foreign('s_no')->references('s_no')->on('s_infos');
            $table->string('url');
            $table->string('hashname');
            $table->string('originalname');
            $table->enum('mvp_photo', ['0', '1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
