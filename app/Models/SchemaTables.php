<?php
/**
 * Application schema tables model class which handel more of relational actions
 *
 * @author Amk El-Kabbany at 29 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Class SchemaTables
 * @package App\Models
 * @version April 28, 2020, 9:49 am UTC
 *
 * @property string  $table
 * @property boolean $altered
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
class SchemaTables extends Model
{
    public $table = 'schema_tables';

    public $fillable = [
        'table',
        'altered'
    ];
}
