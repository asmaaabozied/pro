<?php
/**
 * Common Ajax controller class which handel more of ajax actions
 *
 * @author Amk El-Kabbany at 6 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Core\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

/**
 * Common Ajax base controller class defines common ajax actions
 * @package App\Core\Controllers
 *
 * @author Amk El-Kabbany at 6 May 2020
 * @contact alaa@upbeatdigital.team
 */
class CommonAjaxController extends CustomizedAppBaseController
{
    /**
     * <Ajax POST Action>
     * Retrieve associated cities for given country.

     * @return array
     *
     * @author Amk El-Kabbany at 6 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public function fetchCountryCities()
    {
        $language = Config::get('languages')[Request::ip()]['admin'];
        $name = 'name_'.$language;
        $cities = City::where('country_id', $_GET['country_id'])->orderBy($name)->pluck($name, 'id');

        exit(json_encode($cities)) ;
    }
}
