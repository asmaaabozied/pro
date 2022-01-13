<?php
/**
 * Alter queued application schema tables with system active languages job class.
 *
 * @author Amk El-Kabbany at 29 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Jobs;

use App\Models\SchemaTables;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Altering queued application schema tables with system active languages process class.
 *
 * @author Amk El-Kabbany at 29 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
class AlterQueuedSchemaTableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Tables name array.
     *
     * @var array
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team

     */
    protected $record;

    /**
     * Create a new job instance.
     *
     * @param array  $record --tables name
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct($record = [])
    {
        $this->record = $record;
    }

    /**
     * Handle/Execute the job.
     * Alter given application schema tables chunk with system active languages.
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function handle()
    {
        foreach ($this->record as $record) {
            $seeder = new \AlterApplicationSchemaLanguagesSeeder();
            $seeder->run(trim($record->toArray()['table']));
            $record->fill(['altered' => true]);
            $record->save();
        }
    }
}
