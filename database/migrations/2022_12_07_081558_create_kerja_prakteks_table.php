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
        Schema::create('kerja_prakteks', function (Blueprint $table) {
            $table->id();
            $table->string('THNAKA')->nullable();
            $table->string('Periode')->nullable();
            $table->string('nim')->unique();
            $table->string('DOSEN_PEMB')->nullable();
            $table->string('nmdosen')->nullable();
            $table->string('judul_final')->nullable();
            $table->string('link_laporan_final')->nullable();
            $table->string('link_pendahuluan')->nullable();
            $table->string('link_bab1')->nullable();
            $table->string('link_bab2')->nullable();
            $table->string('link_bab3')->nullable();
            $table->string('link_bab4')->nullable();
            $table->string('link_bab5')->nullable();
            $table->string('link_bab6')->nullable();
            $table->string('link_daftar_pustaka')->nullable();
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
        Schema::dropIfExists('kerja_prakteks');
    }
};
