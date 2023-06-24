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
        Schema::create ('state_options', function (Blueprint $table) {
            // $table->foreignId('s_no')->constrained('s_infos'); // del 0624 jy
            $table->unsignedInteger('s_no'); //add 0624 jy
            // fk 묶는거 이거 좀 아직 수상!!!!!!!!!!!!!!!!!!!!!!!!
            // 해결 0624
            $table->enum('s_parking', ['0','1'])->default('0');
            $table->enum('s_ele', ['0','1'])->default('0');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('s_no')->references('s_no')->on('s_infos'); // add 0624 jy
            $table->primary('s_no'); // add 0624 jy

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_options');
    }
    
};
