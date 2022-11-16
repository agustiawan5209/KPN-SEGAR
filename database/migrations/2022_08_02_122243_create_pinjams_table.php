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
            // $table->foreignId('status_konfirmasis_id')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('status_peminjamans_id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('users_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_peminjam');
            $table->string('jenis_peminjaman');
            $table->string('tujuan')->nullable();
            $table->bigInteger('bunga')->nullable();
            $table->integer('jenis_id')->nullable()->comment('relasi Ke tabel Jenis_Bunga');
            $table->string('jumlah_pinjam');
            $table->date('tgl_pengajuan')->nullable();
            // $table->date('tgl_pinjam');
            $table->date('tgl_kembali')->nullable();
            // $table->string('surat_pinjam');
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
