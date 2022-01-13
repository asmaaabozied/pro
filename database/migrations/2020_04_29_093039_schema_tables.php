<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SchemaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function up()
    {
        Schema::create('schema_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table');
            $table->boolean('altered');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function down()
    {
        Schema::dropIfExists('schema_tables');
    }
}
