<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas_akhirs', function (Blueprint $table) {
            $table->id();
            $table->string('THNAKA')->nullable();
            $table->string('Periode')->nullable();
            $table->string('NIM')->unique();
            $table->string('dsnid_pemb1')->nullable();
            $table->string('Pembimbing1')->nullable();
            $table->string('dsnid_pemb2')->nullable();
            $table->string('Pembimbing2')->nullable();
            $table->string('judul_final')->nullable();
            $table->string('judul_final_eng')->nullable();
            $table->text('abstrak')->nullable();
            $table->text('abstrak_eng')->nullable();
            $table->string('kata_kunci')->nullable();
            $table->string('kata_kunci_eng')->nullable();
            $table->string('link_laporan_final')->nullable();
            $table->string('link_artikel')->nullable();
            $table->string('link_pendahuluan')->nullable();
            $table->string('link_abstrak')->nullable();
            $table->string('link_bab1')->nullable();
            $table->string('link_bab2')->nullable();
            $table->string('link_bab3')->nullable();
            $table->string('link_bab4')->nullable();
            $table->string('link_bab5')->nullable();
            $table->string('link_daftar_pustaka')->nullable();
            $table->string('link_lampiran')->nullable();
            $table->string('link_biodata')->nullable();
            $table->string('akses_user')->nullable();
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
        Schema::dropIfExists('tugas_akhirs');
    }
};
