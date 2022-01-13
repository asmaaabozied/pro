<?php
/**
 * User resource class which handel data display
 *
 * @author Amk El-Kabbany at 12 May 2020
 * @contact alaa@upbeatdigital.team
 */
namespace App\Http\Resources;

use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  User|Collection     $user
     * @param  string   $language
     * @param  boolean  $token
     * @return array
     *
     * @author Amk El-Kabbany at 12 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function toArray($user, $language, $token = false)
    {
        $data= [];
        if($user instanceof Collection) {
            foreach ($user as $item) {
                $data[] = self::map($item, $language, $token);
            }
        } else {
            $data = self::map($user, $language, $token);
        }
        return $data;
    }

    /**
     * Map a resource into an array.
     *
     * @param  User     $user
     * @param  string   $language
     * @param  boolean  $token
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function map($user, $language, $token = false)
    {
        $name = 'name_'.$language;
        $data = [
            'id'            => $user->id,
            'account_type'  => $user->accountType->type,
            'name'          => $user->name,
            'email'         => $user->email,
            'image'         => ($user->image != null && trim($user->image) != '')? asset($user->image) : '',
            'mobile'        => optional($user->country)->key.''.$user->mobile,
            'country'       => optional($user->country)->$name,
            'city'          => optional($user->city)->$name,
            'address'       => $user->address,
            'status'        => $user->status,
            'activated'     => $user->activated,
            'social_media'  => $user->social_media,
            'email_verified'=> $user->email_verified,
            'mobile_verified'=> $user->mobile_verified,
            'firebase_token' => $user->firebase_token,
            'user_code'     => $user->user_code,
        ];

        if($token){
            $data['token'] = $user->getRememberToken();
        }

        return $data;
    }

    /**
     * Map a request array to resource array.
     *
     * @param  array   $input
     * @param  int     $id
     * @return array
     *
     * @author Amk El-Kabbany at 14 May 2020
     * @contact alaa@upbeatdigital.team
     */
    public static function casts($input, $id)
    {
        $user = User::find($id)->toArray();

        return array_replace_recursive($user, $input);
    }
}
