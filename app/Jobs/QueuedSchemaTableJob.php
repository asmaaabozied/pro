<?php
/**
 * Chunks application schema tables job class.
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
class QueuedSchemaTableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Handle/Execute the job.
     * Chunks application schema tables and alter them with system active languages.
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function handle()
    {
        SchemaTables::where('altered', false)->chunk(config('core.chunk_size'), function ($records) {
            dispatch(new AlterQueuedSchemaTableJob($records));
        });
    }
}
