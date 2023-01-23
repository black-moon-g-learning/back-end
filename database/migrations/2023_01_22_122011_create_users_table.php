<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    use ForeignKeyGenerate;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER'])->nullable();
            $table->integer('country_id')->unsigned();
            $table->integer('character_id')->unsigned();
            $table->integer('goal_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->tinyInteger('provider_id')->unsigned();
            $table->string('token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $this->createImageColumn($table);
            $this->createForeignKey($table,'country_id','countries');
            $this->createForeignKey($table,'character_id','characters');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
