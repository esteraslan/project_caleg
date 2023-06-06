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
        Schema::create('pendukungs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_relawan');
            $table->string('name');
            $table->string('no_ktp');
            $table->string('no_kk');
            $table->text('alamat');
            $table->text('keterangan');
            $table->string('jenis_kelamin');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendukungs');
    }
};
