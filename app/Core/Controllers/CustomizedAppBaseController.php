<?php
/**
 * Application base controller class which handel more of business actions
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Core\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\Language;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

/**
 * Application base controller class defines main business actions
 * @package App\Core\Controllers
 *
 * @author Amk El-Kabbany at 28 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
class CustomizedAppBaseController extends AppBaseController
{
    /**
     * Current Logged User
     *
     * @var User
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $currentUser;


    /**
     * Application base controller constructor
     *
     * @author Amk El-Kabbany at 28 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct(){
        $languages = Cache::get('languages');
        if($languages == null || ! array_key_exists(Request::ip(), $languages))
        {
            $languages[Request::ip()]['admin'] = 'en';
            $languages[Request::ip()]['frontend'] = 'ar';
        }
        $system_languages = Language::where('prefix', '!=', 'en')->pluck('prefix');

        View::share([ 'currentUser' => Cache::get('currentUser') ]);
        View::share([ 'language' => $languages[Request::ip()] ]);
        View::share([ 'system_languages' => $system_languages ]);
        Cache::forever('languages' , $languages );
        Config::set('languages', $languages);
    }

    /**
     * Removes the preceding or proceeding portion of a string
     * relative to the last occurrence of the specified character.
     * The character selected may be retained or discarded.
     *
     * @param string $character the character to search for.
     * @param string $string the string to search through.
     * @param string $side determines whether text to the left or the right of the character is returned.
     * Options are: left, or right.
     * @param bool $keep_character determines whether or not to keep the character.
     * Options are: true, or false.
     * @return string
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    static function cut_string_using_last($character, $string, $side, $keep_character=true) {
        $offset = ($keep_character ? 1 : 0);
        $whole_length = strlen($string);
        $right_length = (strlen(strrchr($string, $character)) - 1);
        $left_length = ($whole_length - $right_length - 1);
        switch($side) {
            case 'left':
                $piece = substr($string, 0, ($left_length + $offset));
                break;
            case 'right':
                $start = (0 - ($right_length + $offset));
                $piece = substr($string, $start);
                break;
            default:
                $piece = false;
                break;
        }
        return($piece);
    }

    /**
     * Sets the given system language active through themes.
     *
     * @param string $language
     * @param string $theme
     * @return \Illuminate\Http\RedirectResponse
     *
     * @author Amk El-Kabbany at 29 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    protected function changeLanguage($theme, $language)
    {
        $languages = Cache::get('languages');
        $languages[Request::ip()][$theme] = $language;
        View::share([ 'language' => $languages[Request::ip()] ]);
        Cache::forever('languages' , $languages );
        return redirect(URL::previous());
    }

    /**
     * Alter Application Schema with new Languages.

     * @return \Illuminate\Http\RedirectResponse
     *
     * @author Amk El-Kabbany at 30 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    protected function alterApplicationSchemaWithNewLanguage()
    {
        Artisan::call('schema:update');
        Flash::success(trans('language.messages.schema_altered'));

        return redirect(URL::previous());
    }

    /**
     * Refresh Application Modules Permissions.

     * @return \Illuminate\Http\RedirectResponse
     *
     * @author Amk El-Kabbany at 2 May 2020
     * @contact alaa@upbeatdigital.team
     */
    protected function refreshApplicationModulesPermissions()
    {
        Artisan::call('permissions:refresh');
        Flash::success(trans('role.messages.permission.refreshed'));

        return redirect(URL::previous());
    }
}
