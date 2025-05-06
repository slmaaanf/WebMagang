<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('internship_registrations', function (Blueprint $table) {
            $table->string('cv')->nullable()->change();
            $table->string('rekap_nilai')->nullable()->change();
            $table->string('surat_persetujuan')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('internship_registrations', function (Blueprint $table) {
            $table->string('cv')->nullable(false)->change();
            $table->string('rekap_nilai')->nullable(false)->change();
            $table->string('surat_persetujuan')->nullable(false)->change();
        });
    }
};
