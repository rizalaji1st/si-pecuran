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
        Schema::create('curah_hujan_imports', function (Blueprint $table) {
            $table->id();
            $table->double('curah_hujan');
            $table->unsignedBigInteger('wilayahs_id');
            $table->string('tanggal');
            $table->string('status')->nullable();
            $table->string('pesan_error')->nullable();
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
        Schema::dropIfExists('curah_hujan_imports');
    }
};
