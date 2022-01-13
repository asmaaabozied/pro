<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QueueSchemaTablesSeeder extends Seeder {

    /**
     * Insert schema tables in queue table
     * @param array $tables
     * @return void
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function run($tables) {
        DB::table('schema_tables')->truncate();
        foreach ($tables as $table) {
            DB::table('schema_tables')->insert(['table' => $table->TABLE_NAME, 'altered' => false]);
        }
    }

}
