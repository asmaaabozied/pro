<?php
/**
 * OrderActionsReason resource class which handel data display
 *
 * @author Amk El-Kabbany at 11 July 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\OrderActionsReason;
use Illuminate\Database\Eloquent\Collection;

class OrderActionsReasonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  OrderActionsReason|Collection    $orderActionsReason
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 11 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($orderActionsReason, $language)
    {
        $data= [];
        if($orderActionsReason instanceof Collection) {
            foreach ($orderActionsReason as $item) {
                $data[] = self::map($item, $language);
            }
        } else {
            $data = self::map($orderActionsReason, $language);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  OrderActionsReason    $orderActionsReason
     * @param  string   $language
     * @return array
     *
     * @author Amk El-Kabbany at 11 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($orderActionsReason, $language)
    {
        $title = 'title_'.$language;
        return [
            'id'    => $orderActionsReason->id,
            'title' => $orderActionsReason->$title,
        ];
    }
}
