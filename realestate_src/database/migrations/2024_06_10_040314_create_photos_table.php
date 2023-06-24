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
            $table->softDeletes(); // add 0624 jy : photo 지울때 물리적 삭제 하면 안될거 같음,, 관리자한테 유저가 게시글 잘못 삭제했다고 살려달라 할수도 있지 않음..???
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
