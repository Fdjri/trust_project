<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('id_customer'); // ID pelanggan sebagai primary key
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('nomor_hp_1');
            $table->string('nomor_hp_2')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('tipe_pelanggan', ['first buyer', 'replacement', 'additional'])->nullable();
            $table->enum('jenis_pelanggan', ['retail', 'fleet'])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->integer('tenor')->nullable(); // Lama cicilan jika kredit
            $table->date('tanggal_gatepass')->nullable();
            $table->string('id_cabang'); // Relasi ke tabel branches (string)
            $table->string('salesman')->nullable();
            $table->string('sumber_data')->nullable();
            $table->enum('progress', ['pending', 'tidak ada', 'SPK'])->default('pending');
            $table->text('alasan')->nullable();
            $table->timestamps();

            // Relasi ke tabel branches
            $table->foreign('id_cabang')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};

