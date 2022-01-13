<?php

/**
 * User logged in event tagging class.
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */

namespace App\Events\API\User;
use App\Core\Events\Abstracts\ShouldLog;
use App\User;

/**
 * User logged in event class.
 * @package App\Events\API\User
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */

class UserLoggedIn extends UserModelBasedEvent implements ShouldLog
{
    /**
     * User logged in Event Constructor.
     *
     * @param User $model
     *
     * @author Amk El-Kabbany at 27 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Log system events main messages TODO: change the documentation
     *
     * @return array|string[]
     *
     * @author Amk El-Kabbany at 25 Feb 2019
     * @contact alaa.alkabbany@roaa.com
     */
    public function log(): array{
        return [trans('user.event.logged_in')];
    }
}