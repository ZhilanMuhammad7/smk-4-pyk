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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->date('tgl_mulai_pkl');
            $table->date('tgl_selesai_pkl');
            $table->integer('no_handphone');
            $table->string('alamat');
            $table->string('tempat_pkl');
            $table->string('bidang_kerja');
            $table->string('jurusan');
            $table->string('status')->default('Diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
