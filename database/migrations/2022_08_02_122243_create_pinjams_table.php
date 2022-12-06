<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjams', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman');
            $table->foreignId('barangs_id')->nullable();
            $table->string('kode_anggota')->nullable();
            $table->foreignId('users_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_peminjam');
            $table->string('jenis_peminjaman');
            $table->bigInteger('bunga')->nullable();
            $table->string('jumlah_pinjam');
            $table->date('tgl_pengajuan')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->string('surat_pinjam')->nullable();
            $table->string('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjams');
    }
}
