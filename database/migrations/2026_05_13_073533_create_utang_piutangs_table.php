<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utang_piutangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('tipe', ['customer', 'supplier']);
            $table->bigInteger('total_tagihan');
            $table->bigInteger('dp')->default(0);
            $table->bigInteger('sisa_pembayaran')->default(0);
            $table->enum('status', ['belum_lunas', 'lunas'])->default('belum_lunas');
            $table->text('keterangan')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('utang_piutangs');
    }
};