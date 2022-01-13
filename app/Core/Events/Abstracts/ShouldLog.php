<?php

/**
 * ShouldLog event listener class. TODO: change the documentation
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Core\Events\Abstracts;

/**
 * ShouldLog event listener class. TODO: change the documentation
 * @package App\Core\Events\Abstracts
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */


interface ShouldLog
{

    /**
     * Log system events main messages TODO: change the documentation
     *
     * @return array
     *
     * @author Amk El-Kabbany at 27 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function log() : array ;
}