<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->string('nama_lengkap', 200);
            $table->string('foto_ktp', 200);
            $table->string('pekerjaan', 40)->nullable();
            $table->string('gaji', 40);
            $table->string('pendidikan', 40)->nullable();
            $table->string('jenkel', 40);
            $table->string('tempat_lahir', 40);
            $table->date('tgl_lahir', 40);
            $table->enum('status', ['menikah', 'tidak menikah']);
            $table->string('tanggungan', 40)->nullable();
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
        Schema::dropIfExists('detail_anggotas');
    }
}
