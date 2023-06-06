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
        Schema::create('relawans', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('name');
            $table->integer('jenis_kelamin');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->string('organisasi');
            $table->string('no_hp', 14);
            $table->integer('sts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relawans');
    }
};
