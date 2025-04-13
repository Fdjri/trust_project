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
    Schema::create('follow_ups', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id');
        $table->unsignedBigInteger('salesman_id');
        $table->date('followup_date');
        $table->enum('status', ['pending', 'spk', 'rejected']);
        $table->string('channel')->nullable(); // telp, WA, visit, dll
        $table->text('notes')->nullable();
        $table->timestamps();

        $table->foreign('customer_id')->references('id_customer')->on('customers')->onDelete('cascade');
        $table->foreign('salesman_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
    }
};
