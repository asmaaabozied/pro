<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Language;
use App\Core\Controllers\CustomizedAppBaseController;
use App\Models\SchemaTables;

class AlterApplicationSchemaLanguagesSeeder extends Seeder {

    /**
     * Duplicating each data base column ends with '_en' with the rest of current system languages
     * @param string $table_name
     * @return void
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function run($table_name) {
        $query = DB::select('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env('DB_DATABASE') . '" and TABLE_NAME = "'.$table_name.'" and COLUMN_NAME like "%_en"');
        $languages = Language::where('prefix', '!=', 'en')->get()->pluck('prefix');

        foreach ($languages as $language) {
            $check_query = DB::select('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env('DB_DATABASE') . '" and TABLE_NAME = "'.$table_name.'" and COLUMN_NAME like "%_' . $language . '"');
            if (empty($check_query))
                foreach ($query as $column) {
                    $naming = CustomizedAppBaseController::cut_string_using_last('_', $column->COLUMN_NAME, 'left', false);
                    $column_type = DB::select('SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env('DB_DATABASE') . '" and TABLE_NAME = "'.$table_name.'" and COLUMN_NAME = "' . $column->COLUMN_NAME . '"');
                    $column_maximum_length = DB::select('SELECT CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env('DB_DATABASE') . '" and TABLE_NAME = "'.$table_name.'" and COLUMN_NAME = "' . $column->COLUMN_NAME . '"');
                    $temp_query = DB::statement('ALTER TABLE '.$table_name.' ADD ' . $naming . '_' . $language . ' ' . $column_type[0]->DATA_TYPE . '(' . $column_maximum_length[0]->CHARACTER_MAXIMUM_LENGTH . ')' . ' after ' . $column->COLUMN_NAME);
                }

                $check_query = DB::select('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env('DB_DATABASE') . '" and TABLE_NAME = "'.$table_name.'" and COLUMN_NAME = "en"');
                if(! empty($check_query)){
                    $check_query = DB::select('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env('DB_DATABASE') . '" and TABLE_NAME = "'.$table_name.'" and COLUMN_NAME = "' . $language . '"');
                    if(empty($check_query))
                        $temp_query = DB::statement('ALTER TABLE '.$table_name.' ADD ' . $language . ' TinyInt(1) after en');

                }
        }
    }

}
