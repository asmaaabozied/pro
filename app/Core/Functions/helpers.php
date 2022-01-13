<?php

use Illuminate\Support\Facades\DB;
use App\Models\Language;
use App\Core\Controllers\CustomizedAppBaseController;

/**
 * Alter given language titles with it's equivalents.
 *
 * @param string $table
 * @param array $data
 * @param string $key
 * @param string $language
 * @return array
 *
 * @author Amk El-Kabbany at 29 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
function alterLangFiles($table, $data, $key = 'fields', $language = 'en')
{
    $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
    $query = DB::select('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env('DB_DATABASE') . '" and TABLE_NAME = "'.$table.'" and COLUMN_NAME like "%_en"');
    foreach ($system_languages as $system_language) {
        foreach ($query as $column) {
            $naming = CustomizedAppBaseController::cut_string_using_last('_', $column->COLUMN_NAME, 'left', false);
            if($language == 'ar'){
                $data[$key][$naming . '_' . $system_language] = $system_language . $data[$key][$column->COLUMN_NAME] . ' بلغة ال ';
            } else {
                $data[$key][$naming . '_' . $system_language] = $data[$key][$column->COLUMN_NAME] . ' in ' . strtoupper($system_language) . ' Language';
            }
            $data[$key][$naming . '_' . $system_language . '_help'] = $data[$key][$column->COLUMN_NAME . '_help'];
        }
    }

    return $data;
}

/**
 * Alter given array with it's equivalents language elements.
 *
 * @param string $table
 * @param array $data
 * @param string $key
 * @return array
 *
 * @author Amk El-Kabbany at 29 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
function alterLangArrayElements($table, $data, $key = 'fields')
{
    $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');
    $query = DB::select('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env('DB_DATABASE') . '" and TABLE_NAME = "'.$table.'" and COLUMN_NAME like "%_en"');
    foreach ($system_languages as $system_language) {
        foreach ($query as $column) {
            $naming = CustomizedAppBaseController::cut_string_using_last('_', $column->COLUMN_NAME, 'left', false);
            if(key_exists($column->COLUMN_NAME,$data[$key])) {
                $data[$key][$naming . '_' . $system_language] = $data[$key][$column->COLUMN_NAME];
            }
        }
        $query = DB::select('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = "' . env('DB_DATABASE') . '" and TABLE_NAME = "' . $table . '" and COLUMN_NAME = "en"');
        if(! empty($query)){
            foreach ($system_languages as $system_language) {
                foreach ($query as $column) {
                    if(key_exists($column->COLUMN_NAME, $data[$key])) {
                        $data[$key][$system_language] = $data[$key][$column->COLUMN_NAME];
                    }
                }
            }
        }

        return $data;
    }
}