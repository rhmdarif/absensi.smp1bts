<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterTeacherAttendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_teacher_attends', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->integer('total_hadir')->default(0);
            $table->integer('total_terlambat')->default(0);
            $table->integer('total_izin')->default(0);
            $table->integer('total_tdk_hadir')->default(0);
            $table->boolean('status')->default(0);
            $table->date('tanggal')->nullable();
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
        Schema::dropIfExists('master_teacher_attends');
    }
}
