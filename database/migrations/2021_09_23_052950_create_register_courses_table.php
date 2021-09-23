<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_courses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('rc_userId');
            $table->foreign('rc_userId')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('rc_courseId');
            $table->foreign('rc_courseId')->references('id')->on('courses')->onDelete('cascade');
            
            $table->string('rc_status')->default('valid');
            $table->string('rc_complete')->default(0);
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
        Schema::dropIfExists('register_courses');
    }
}
