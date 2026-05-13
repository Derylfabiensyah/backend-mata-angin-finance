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
        Schema::create('utang_piutangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_customer');
            $table->string('jenis');
            $table->bigInteger('total_tagihan');
            $table->bigInteger('dp');
            $table->bigInteger('sisa_pembayaran');
            $table->date('tanggal_dp');
            $table->date('tanggal_pelunasan');
            $table->string('status');
            $table->text('keterangan');
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
        Schema::dropIfExists('utang_piutangs');
    }
};
