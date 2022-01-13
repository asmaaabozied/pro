<?php

/**
 * Abstract user model base event tagging class. TODO: change the documentation
 *
 *@author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */

namespace App\Events\API\User;

use App\Events\ModelBasedEvent;
use App\User;

/**
 * Abstract user model base event class.
 * @package App\Events\API\User
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */

abstract class UserModelBasedEvent extends ModelBasedEvent
{
    /**
     * User ModelBased Event Constructor.
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
     * Get current event request user model.
     *
     * @return User
     *
     * @author Amk El-Kabbany at 27 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function getUser(): User
    {
        return $this->getModel();
    }

}