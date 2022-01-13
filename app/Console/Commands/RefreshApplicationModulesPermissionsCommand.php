<?php
/**
 * Refresh application modules permissions custom artisan command create class.
 *
 * @author Amk El-Kabbany at 2 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Create artisan command for refreshing application modules permissions.
 *
 * @author Amk El-Kabbany at 2 May 2020
 * @contact alaa@upbeatdigital.team
 */
class RefreshApplicationModulesPermissionsCommand extends Command
{
    /**
     * Console artisan command signature/slug.
     *
     * @var string
     *
     * @author Amk El-Kabbany at 2 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $signature = 'permissions:refresh';

    /**
     * Console artisan command description.
     *
     * @var string
     *
     * @author Amk El-Kabbany at 2 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $description = 'Refresh application modules permissions';

    /**
     * Handle/Execute this artisan command.
     * Seeds new modules permission.
     *
     * @author Amk El-Kabbany at 2 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function handle()
    {
        $seeder = new \PermissionsTableSeeder();
        $seeder->run();
    }
}
