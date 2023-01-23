<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use ForeignKeyGenerate;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->string('image')->nullable();
            $table->integer('country_id')->nullable()->unsigned();
            $table->integer('video_id')->nullable()->unsigned();
            $table->integer('type_id')->nullable()->unsigned();
            $table->tinyInteger('level_id')->nullable()->unsigned();

            $this->createForeignKey($table,'country_id','countries');
            $this->createForeignKey($table,'video_id','videos');
            $this->createForeignKey($table,'type_id','types');
            $this->createForeignKey($table,'level_id','game_levels');

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
        Schema::dropIfExists('questions');
    }
};
