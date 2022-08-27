<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flips', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('title', 255);
            $table->text('desc')->nullable();
            $table->string('type', 10)->default('public');
            $table->string('sector', 10)->nullable();
            $table->string('pdf', 255)->nullable();
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
        Schema::dropIfExists('flips');
    }
}
