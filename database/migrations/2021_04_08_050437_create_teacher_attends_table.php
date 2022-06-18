<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherAttendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_attends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id');
            $table->string('qr_code')->nullable();
            $table->foreignId("master_teacher_attend_id");
            $table->integer('status')->default(3); // 1 Hadir ; 2 Terlambat ; 3 Izin/Sakit ; 4 Tidak ada
            $table->boolean('confirmed')->default(false);
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
        Schema::dropIfExists('teacher_attends');
    }
}
