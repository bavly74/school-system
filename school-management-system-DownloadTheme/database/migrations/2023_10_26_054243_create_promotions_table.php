<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');

            $table->foreignId('from_grade')->constrained('grades')->onDelete('cascade');
            $table->foreignId('from_Classroom')->constrained('classrooms')->onDelete('cascade');
            $table->foreignId('from_section')->constrained('sections')->onDelete('cascade');
            $table->integer('from_year');

            $table->integer('to_year');
            $table->foreignId('to_grade')->constrained('grades')->onDelete('cascade');
            $table->foreignId('to_Classroom')->constrained('classrooms')->onDelete('cascade');
            $table->foreignId('to_section')->constrained('sections')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('promotions');
    }
}
