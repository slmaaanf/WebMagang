<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('institution');
        $table->string('major');
        $table->string('name');
        $table->string('nik')->unique();
        $table->string('email')->unique();
        $table->string('phone');
        $table->string('password');
        if (!Schema::hasColumn('users', 'role')) {
            $table->string('role')->default('user');
        }
        $table->timestamps();
      });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
