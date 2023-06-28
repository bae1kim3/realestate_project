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
        Schema::create('seller_license_nos', function (Blueprint $table) {
            $table->unsignedInteger('license_no')->primary();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('u_id', 100)->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('phone_no');
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('u_at')->default('0');
            $table->string('u_addr');
            $table->unsignedInteger('seller_license')->nullable();
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->enum('animal_size', ['0', '1']);
            $table->enum('pw_question', ['0','1','2','3','4']);
            $table->string('pw_answer');
            $table->string('b_name')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('seller_license')
                ->references('license_no')
                ->on('seller_license_nos')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('seller_license_nos');
    }
};
