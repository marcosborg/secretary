<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLifeMinistryEventsTable extends Migration
{
    public function up()
    {
        Schema::table('life_ministry_events', function (Blueprint $table) {
            $table->unsignedBigInteger('life_ministry_id')->nullable();
            $table->foreign('life_ministry_id', 'life_ministry_fk_7895854')->references('id')->on('life_ministries');
            $table->unsignedBigInteger('assignment_id')->nullable();
            $table->foreign('assignment_id', 'assignment_fk_7895855')->references('id')->on('assignments');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_7895859')->references('id')->on('students');
        });
    }
}
