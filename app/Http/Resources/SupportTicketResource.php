<?php
/**
 * SupportTicket resource class which handel data display
 *
 * @author Amk El-Kabbany at 8 June 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\Models\SupportTicket;
use Illuminate\Database\Eloquent\Collection;

class SupportTicketResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  SupportTicket|Collection  $supportTicket
     * @return array
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($supportTicket)
    {
        $data= [];
        if($supportTicket instanceof Collection) {
            foreach ($supportTicket as $item) {
                $data[] = self::map($item);
            }
        } else {
            $data = self::map($supportTicket);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  SupportTicket  $supportTicket
     * @return array
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($supportTicket)
    {
        $data = [
            'id'            => $supportTicket->id,
            'type'          => $supportTicket->type,
            'name'          => $supportTicket->name,
            'email'         => $supportTicket->email,
            'phone'         => $supportTicket->phone,
            'message'       => $supportTicket->message,
            'responded'     => $supportTicket->responded,
        ];

        return $data;
    }

    /**
     * Map a request array to resource array.
     *
     * @param  array   $input
     * @param  int     $id
     * @return array
     *
     * @author Amk El-Kabbany at 8 June 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $id)
    {
        $supportTicket = SupportTicket::find($id)->toArray();

        return array_replace_recursive($supportTicket, $input);
    }
}
