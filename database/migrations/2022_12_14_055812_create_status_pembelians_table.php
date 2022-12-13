<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_pembelians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_id')->constrained('pembelians')->onDelete('cascade');
            $table->string('status',100);
            $table->string('ket',200);
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
        Schema::dropIfExists('status_pembelians');
    }
}
