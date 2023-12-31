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
        Schema::create('tps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('id_kab');
            $table->integer('id_kec');
            $table->biginteger('id_kel');
            $table->string('no_rt', 20)->nullable();
            $table->string('no_rw', 20)->nullable();
            $table->string('nm_kp')->nullable();
            $table->integer('sts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tps');
    }
};
