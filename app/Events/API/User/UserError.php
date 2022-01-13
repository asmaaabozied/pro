<?php

/**
 * User error event tagging class.
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */

namespace App\Events\API\User;
use App\Core\Events\Abstracts\ShouldLog;
use App\Events\BaseEvent;

/**
 * User error event class.
 * @package App\Events\API\User
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */

class UserError extends BaseEvent implements ShouldLog
{
    /**
     * Log system events main messages TODO: change the documentation
     *
     * @return array|string[]
     *
     * @author Amk El-Kabbany at 27 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function log(): array{
        return [trans('user.event.error')];
    }
}