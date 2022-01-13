<?php

/**
 * Product added event class.
 *
 * @author Amk El-Kabbany at 16 July 2020
 * @contact alaa@upbeatdigital.team
 */

namespace App\Events\API\Product;

use App\Core\Events\Abstracts\Notify;
use App\Events\BaseEvent;
use App\Models\Language;
use App\Models\Notification;
use App\Models\NotifiedUser;
use App\Models\Product;
use App\User;
use App\Helpers\Notification as NotificationHelper;

class ProductAdded extends BaseEvent implements Notify
{
    /**
     * Added product object.
     *
     * @var Product
     *
     * @author Amk El-Kabbany at 16 July 2020
     * @contact alaa@upbeatdigital.team
     */
    protected $product;

    /**
     * Product added event class Constructor.
     *
     * @param Product $product
     *
     * @author Amk El-Kabbany at 16 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function __construct($product)
    {
        $this->product = $product;
        $this->notify();
    }

    /**
     * Retrieve added product.
     *
     * @return  Product
     *
     * @author Amk El-Kabbany at 16 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * Notify system users for specific announcement
     *
     * @author Amk El-Kabbany at 16 July 2020
     * @contact alaa@upbeatdigital.team
     */
    public function notify()
    {
        $notification = new Notification();
        $data = [
            'type'              => 'system',
            'module'            => 'products',
            'module_id'         => $this->product->id,
            'active'            => true,
        ];

        foreach(Language::all() as $languageItem) {
            $data['notification_'.$languageItem->prefix] = trans('product.notifications.new_product');
        }
        $notification->fill($data)->save();

        $users = User::where('firebase_token', '!=', null)->get();

        foreach($users as $user){
            NotificationHelper::firebase_notification($user->firebase_token, trans('product.notifications.new_product'), $this->product->title_en, ['module' => 'products', 'module_id' => $this->product->id, 'icon' => asset($this->product->mainImage())]);
            $notifiedUser = new NotifiedUser();
            $notifiedUser->fill([
                'notification_id'   => $notification->id,
                'user_id'           => intval($user->id),
            ])->save();
        }
    }
}
