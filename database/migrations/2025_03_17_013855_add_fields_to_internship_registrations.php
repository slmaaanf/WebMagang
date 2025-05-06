<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('internship_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('university');
            $table->string('nik', 16);
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('rekap_nilai');
            $table->string('surat_persetujuan');
            $table->string('cv');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('internship_registrations');
    }
};


