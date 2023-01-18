<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClmMeetingsTable extends Migration
{
    public function up()
    {
        Schema::create('clm_meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
