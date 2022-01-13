<?php
/**
 * Alter application schema tables with system active languages custom artisan command create class.
 *
 * @author Amk El-Kabbany at 29 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Console\Commands;

use App\Jobs\AlterQueuedSchemaTableJob;
use App\Models\SchemaTables;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Create artisan command for altering application schema tables with system active languages.
 *
 * @author Amk El-Kabbany at 29 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
class AlterApplicationSchemaLanguagesCommand extends Command
{
    /**
     * Console artisan command signature/slug.
     *
     * @var string
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $signature = 'schema:update {table_name? : Selected table name.}';

    /**
     * Console artisan command description.
     *
     * @var string
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $description = 'Alter application schema tables with system active languages';

    /**
     * Handle/Execute this artisan command.
     * Chunks queued tables and dispatch seeder class.
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function handle()
    {
        if(! SchemaTables::where('altered', false)->exists()) {
            $tables = DB::select('SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = "' . env('DB_DATABASE'). '"');
            $seeder = new \QueueSchemaTablesSeeder();
            $seeder->run($tables);
            SchemaTables::when(trim($this->argument('table_name')), function ($query) {
                return $query->where('table', trim($this->argument('table_name')));
            })->where('altered', false)->chunk(20, function ($records) {
                dispatch(new AlterQueuedSchemaTableJob($records));
            });
        }
    }
}
