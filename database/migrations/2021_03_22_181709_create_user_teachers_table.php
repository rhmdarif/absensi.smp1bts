<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('kode_guru', 8)->unique();
            $table->string('nip')->nullable();
            $table->boolean('jenis_kelamin')->default(0); // 0 : Perempuan ; 1 = Laki-laki;
            $table->string('foto')->nullable();
            $table->string('nohp')->nullable();
            $table->text('alamat')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('golongan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('jabatan')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_teachers');
    }
}
