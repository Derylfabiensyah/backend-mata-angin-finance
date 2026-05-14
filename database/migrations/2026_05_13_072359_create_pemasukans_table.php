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
        Schema::create('pemasukans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('hari');
            $table->bigInteger('cash')->default(0);
            $table->bigInteger('transfer_bca')->default(0);
            $table->bigInteger('qris_dana')->default(0);
            $table->bigInteger('denda')->default(0);
            $table->bigInteger('kerusakan')->default(0);
            $table->bigInteger('dp')->default(0);
            $table->bigInteger('total_pemasukan')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukans');
    }
};
