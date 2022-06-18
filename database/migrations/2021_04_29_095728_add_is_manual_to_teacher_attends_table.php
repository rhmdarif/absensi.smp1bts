<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsManualToTeacherAttendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_attends', function (Blueprint $table) {
            //
            $table->boolean('is_manual')->default(0);
            $table->text('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_attends', function (Blueprint $table) {
            //
            $table->dropColumn(['is_manual', 'keterangan']);
        });
    }
}
