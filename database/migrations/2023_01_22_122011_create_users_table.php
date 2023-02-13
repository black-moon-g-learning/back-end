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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER'])->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('character_id')->unsigned()->nullable();
            $table->integer('target_id')->unsigned()->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->tinyInteger('provider_id')->unsigned()->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $this->createImageColumn($table);

            $this->createForeignKey($table, 'country_id', 'countries');
            $this->createForeignKey($table, 'character_id', 'characters');
            $this->createForeignKey($table, 'role_id', 'roles');
            $this->createForeignKey($table, 'target_id', 'targets');

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
