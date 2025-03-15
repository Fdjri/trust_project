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
        $table->string('id_cabang'); // ID cabang (string)
        $table->enum('role', ['admin', 'kepala_cabang', 'supervisor', 'salesman']); // Role user
        $table->rememberToken();
        $table->timestamps();
    });
}
};