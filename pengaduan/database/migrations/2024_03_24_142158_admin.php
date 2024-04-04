<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->id('id_role');
            $table->string('role');
            $table->timestamps();
        });
        Schema::create('status_pengaduan', function (Blueprint $table) {
            $table->id('id_status');
            $table->string('status');
            $table->timestamps();
        });
        Schema::create('status_user', function (Blueprint $table) {
            $table->id('id_status');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id_role')->on('role');
            $table->unsignedBigInteger('id_status');
            $table->foreign('id_status')->references('id_status')->on('status_user');
            $table->string('nama_lengkap');
            $table->string('nip')->unique();
            $table->string('username')->unique();
            $table->string('telephone')->nullable();
            $table->string('password');
            $table->timestamps();
        });
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->string('kode_pengaduan');
            $table->unsignedBigInteger('id_status');
            $table->foreign('id_status')->references('id_status')->on('status_pengaduan');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('user');
            $table->string('nama_barang');
            $table->string('keterangan');
            $table->string('catatan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('role');
        Schema::dropIfExists('status_pengaduan');
        Schema::dropIfExists('status_user');
        Schema::dropIfExists('user');
        Schema::dropIfExists('pengaduan');
    }
};
