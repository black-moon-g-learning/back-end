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
        Schema::create('contributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 500);
            $table->text('description');
            $table->text('image');
            $table->text('video');
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('owner_id')->unsigned()->nullable();

            $this->createForeignKey($table, 'country_id', 'countries');
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
        Schema::dropIfExists('contributes');
    }
};
