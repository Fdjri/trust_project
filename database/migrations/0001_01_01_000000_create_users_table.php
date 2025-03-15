<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique(); // Menggunakan username untuk login
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('id_cabang')->nullable(); // Membuat id_cabang opsional
            $table->foreign('id_cabang')->references('id')->on('branches')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_cabang']); // Hapus foreign key sebelum drop tabel
        });

        Schema::dropIfExists('users');
    }
};