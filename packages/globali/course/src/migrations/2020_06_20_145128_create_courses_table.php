<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longtext('description');
            $table->string('image');
            $table->string('faculty');
            $table->string('associated_uni');
            $table->longtext('opportunities');
            $table->enum('online_course',[1,0])->default(1);
            $table->enum('online_exam',[1,0])->default(1);
            $table->string('associated_teacher');
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
        Schema::dropIfExists('courses');
    }
}
