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
        Schema::create('users_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('order_id')->nullable();
            $table->enum('process', ['SUCCESS', 'DOING', 'FAIL'])->nullable();
            $table->string('payment')->nullable();
            $table->tinyInteger('service_id')->unsigned();
            $table->timestamps();

            $this->createForeignKey($table, 'user_id', 'users');
            $this->createForeignKey($table, 'service_id', 'services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_payments');
    }
};
