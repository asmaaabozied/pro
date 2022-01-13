<?php

/**
 * Localization trait class
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Core\Traits;

/**
 * Localization trait class which accept locale variable
 * @package App\Core\Events\Abstracts
 *
 * @author Amk El-Kabbany at 17 May 2020
 * @contact alaa@upbeatdigital.team
 */


trait Localization
{

    /**
     * Accept locale variable from the request
     *
     * @return string
     *
     * @author Amk El-Kabbany at 17 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function localization() {
        if(env('LOCALIZE_API') == 'header') {
            return request()->header('Accept-Language');
        }
        return request()->input('language');
    }
}