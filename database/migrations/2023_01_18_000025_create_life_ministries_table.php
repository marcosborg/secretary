<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLifeMinistriesTable extends Migration
{
    public function up()
    {
        Schema::create('life_ministries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->boolean('disabled')->default(0)->nullable();
            $table->string('reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
