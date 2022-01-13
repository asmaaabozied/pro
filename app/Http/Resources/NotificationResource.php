<?php
/**
 * Notification resource class which handel data display
 *
 * @author Amk El-Kabbany at 1 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;

class NotificationResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Notification|Collection  $notification
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 1 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($notification, $language)
    {
        $data= [];
        if($notification instanceof Collection) {
            foreach ($notification as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($notification, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  Notification    $notification
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 1 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($notification, $language)
    {
        $title = 'notification_'.$language;
        $data =  [
            'id'            => $notification->id,
            'notification'  => $notification->$title,
            'date'          => date('Y-m-d', strtotime($notification->created_at)),
            'module'        => null,
            'module_id'     => null,
        ];
        if($notification->type == 'system'){
            $data['module'] = $notification->module;
            $data['module_id'] = $notification->module_id;
        }

        return $data;
    }
}
