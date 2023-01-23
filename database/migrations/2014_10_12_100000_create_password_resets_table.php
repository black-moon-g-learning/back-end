<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Database\Schema\ForeignKeyDefinition;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
};
trait ForeignKeyGenerate
{
    /**
     * @var int
     */
    private int $urlLength = 500;

    /**
     * @param Blueprint $table
     * @param string $foreignKey
     * @param string $reference
     * @param string $tableName
     * @return ForeignKeyDefinition
     */
    public function createForeignKey(Blueprint $table, string $foreignKey, string $tableName,string $reference = 'id'): ForeignKeyDefinition
    {
        return $table->foreign($foreignKey)
            ->references($reference)
            ->on($tableName)
            ->onDelete('cascade')
            ->onUpdate('cascade');
    }

    /**
     * @param Blueprint $table
     * @return ColumnDefinition
     */
    public function createImageColumn(Blueprint $table): ColumnDefinition
    {
        return $table->string('image',$this->urlLength)->nullable();
    }
}
