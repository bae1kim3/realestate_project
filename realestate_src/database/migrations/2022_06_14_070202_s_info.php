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
        Schema::create('s_infos', function (Blueprint $table) {
            $table->increments('s_no');
            $table->unsignedBigInteger('u_no'); // 외래 키
            $table->foreign('u_no')->references('id')->on('users');
            $table->string('s_name', 100);
            $table->string('s_add', 500);
            $table->enum('s_type', ['매매', '전세', '월세']);
            $table->integer('s_size');
            $table->integer('s_fl');
            $table->enum('s_widra', ['0', '1'])->default('0');
            $table->string('s_stai', 30);
            $table->string('s_log', 100);
            $table->string('s_lat', 100);
            $table->integer('p_deposit'); // add 0617 jy
            $table->integer('p_month')->nullable(); // add 0617 jy
            $table->enum('animal_size', ['0','1']); // add 0618 jy
            $table->integer('hits'); // add 0714 jy
            $table->enum('s_option', ['0','1','2','3','4']); // add 0714 jy 아파트 0,단독주택 1, 오피스텔2, 빌라3, 원룸4
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_infos');
    }
};
