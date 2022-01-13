<?php
/**
 * Abstract base event tagging class. TODO: change the documentation
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Events;

use App\Core\Events\Abstracts\TriggerableEvent;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Abstract base event class. TODO: change the documentation
 * @package App\Events
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */

class BaseEvent implements TriggerableEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * BaseEvent constructor.
     */
    public function __construct()
    {
    }

}