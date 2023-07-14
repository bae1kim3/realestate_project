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
        Schema::create ('announcement_info', function (Blueprint $table) {
            $table->id();
            $table->string('ann_title', 100);
            $table->string('ann_content',10000);
            // $table->timestamp('write_date');
            // $table->timestamp('update_date')->nullable();
            // $table->timestamp('delete_date')->nullable();
            $table->timestamps();
            $table->softDeletes(); //model에 use 소프트딜리트 추가하셈

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcement_info');
    }
};
