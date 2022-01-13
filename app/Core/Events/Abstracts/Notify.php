<?php

/**
 * Notify event listener class. TODO: change the documentation
 *
 * @author Amk El-Kabbany at 16 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Core\Events\Abstracts;

/**
 * Notify event listener class. TODO: change the documentation
 * @package App\Core\Events\Abstracts
 *
 * @author Amk El-Kabbany at 16 July 2020
 * @contact alaa@upbeatdigital.team
 */


interface Notify
{

    /**
     * Notify system users for specific announcement TODO: change the documentation
     *
     * @author Amk El-Kabbany at 16 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function notify();
}