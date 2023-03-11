<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // add more columns by    DB::statement('ALTER TABLE countries ADD FULLTEXT `search` (`name`,`acasc`,`adsf`)');
        DB::statement('ALTER TABLE countries ADD FULLTEXT `search` (`name`)');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
