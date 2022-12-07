<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngsuransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjam_id')->nullable();
            $table->string('kode_angsuran',10);
            $table->date('tgl_angsuran');
            $table->string('jumlah_bayar',20);
            $table->string('sisa_bayar', 20);
            $table->enum('status', ['0','1','2'])->comment('0 :belum dibayar, 1: telat, 2 : dibayar');
            $table->integer('denda')->nullable();
            $table->integer('jumlah_denda')->nullable();
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
        Schema::dropIfExists('angsurans');
    }
}
