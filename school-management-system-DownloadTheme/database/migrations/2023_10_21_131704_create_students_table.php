<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            //$table->bigInteger('gender_id')->unsigned();
            $table->foreignId('gender_id')->constrained('genders')->onDelete('cascade');
            //$table->bigInteger('nationalitie_id')->unsigned();
            $table->foreignId('nationality_id')->constrained('nationalities')->onDelete('cascade');
           // $table->bigInteger('blood_id')->unsigned();
            $table->foreignId('blood_id')->constrained('bloods')->onDelete('cascade');
            $table->date('Date_Birth');
            //$table->bigInteger('Grade_id')->unsigned();
            $table->foreignId('Grade_id')->constrained('grades')->onDelete('cascade');
            //$table->bigInteger('Classroom_id')->unsigned();
            $table->foreignId('Classroom_id')->constrained('classrooms')->onDelete('cascade');
            //$table->bigInteger('section_id')->unsigned();
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            //$table->bigInteger('parent_id')->unsigned();
            $table->foreignId('parent_id')->constrained('my_parents')->onDelete('cascade');
            $table->string('academic_year');
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
        Schema::dropIfExists('students');
    }
}
