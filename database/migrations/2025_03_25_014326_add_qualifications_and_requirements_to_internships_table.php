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
        Schema::table('internships', function (Blueprint $table) {
            $table->text('qualifications')->after('location'); // Tambah kolom kualifikasi
            // $table->text('requirements')->after('qualifications'); // Tambah kolom persyaratan
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('internships', function (Blueprint $table) {
          if (Schema::hasColumn('internships', 'qualifications', )) {
            $table->dropColumn('qualifications');
          }
          if (Schema::hasColumn('internships', 'requirements')){
            $table->dropColumn('requirements');
          }
            //
            
        });
    }
};
