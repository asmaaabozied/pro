<?php
/**
 * BaseAPI controller class which acting as parent for all APIs
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Core\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

/**
 * Abstract base controller class defines main business actions
 * @package App\Core\Controllers\APIs
 *
 * @author Amk El-Kabbany at 27 Apr 2020
 * @contact alaa@upbeatdigital.team
 */
abstract class BaseAPI extends Controller
{
    /**
     * Given Request data.
     *
     * @var Request
     *
     * @author Amk El-Kabbany at 27 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $request;

    /**
     * @param Request $request
     *
     * @author Amk El-Kabbany at 27 Apr 2020
     * @contact alaa@upbeatdigital.team
     */
    function __constructor(Request $request){
        $this->request = $request;
    }

    /**
     * Logic action to handel messages returned from validator
     * @param MessageBag $errors
     * @return array
     *
     * @author Amk El-Kabbany at 11 May 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function handelValidationErrors($errors){
        $messages = [];
        foreach ($errors->toArray() as $field => $error) {
            $messages[$field] = $error[0];

        }
        return $messages;
    }

    /**
     * Logic action to handel messages exists in flash session
     * @param  string $baseErrorMessage
     * @return array|boolean
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    static public function handelFlashErrors($baseErrorMessage = ''){
        $messages = "";
        foreach (session('flash_notification', collect())->toArray() as $message) {
            if($message['level'] == 'danger'){
                $messages .= $message['message'] . ', ';
            }
        }

        if(empty(trim($messages))){
            return false;
        } else {
            return ($baseErrorMessage != '')
                ?  $baseErrorMessage.', '.$messages
                :  $messages;
        }
    }
}
