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
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('country_topic_id');
            $table->string('url', 500)->nullable();
            $table->unsignedInteger('owner_id');
            $table->integer('time')->unsigned();
            
            $this->createForeignKey($table, 'country_topic_id', 'countries_topics');
            $this->createForeignKey($table, 'owner_id', 'users');

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
        Schema::dropIfExists('videos');
    }
};
