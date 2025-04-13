<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_users_table.php
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('branch_id')->nullable(); // hanya untuk kepala cabang, supervisor, salesman
        $table->string('name');
        $table->string('username')->unique();
        $table->string('email')->unique()->nullable();
        $table->string('password');
        $table->enum('role', ['admin', 'kepala_cabang', 'supervisor', 'salesman']);
        $table->rememberToken();
        $table->timestamps();

        $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
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