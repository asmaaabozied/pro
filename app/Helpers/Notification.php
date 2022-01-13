<?php

namespace App\Helpers;

class Notification{
    public static function firebase_notification($token, $title, $body, $data = [])
    {
        if(empty($token)){
            return false;
        }
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token  = $token;
        $url = "https://partoro.com/demo/";

        if(isset($data['module']) && $data['module'] == "products"){
            $url = "https://partoro.com/demo/Product/" . $data['module_id'];
        }

        if(isset($data['module']) && $data['module'] == "orders"){
            $url = "https://partoro.com/demo/profile/products/order/" . $data['module_id'];
        }

        $notification = [
            'title' => $title,
            'body' => $body,
            'click_action'     => $url,
            'navigation' => $data,
            'sound' => true
        ];

        if(isset($data['icon'])){
            $notification['icon'] = $data['icon'];
        }
        
        $extraNotificationData = ["message" => $notification,"moredata" => $data];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData,
            'click_action'     => $url,
        ];

        $headers = [
            'Authorization: key=AAAAqakTbzY:APA91bFg0p-WiPFkt_ICHDFEa_0OwpaVKxY2RrM0T6mxm2WIws0QqAwp3-xhAD3pqdm8WAsjnwVtorBYpEv7QqBPTJW76NQofNHwHeSOR72_tYZlx_vEeJDs2rGFKLDM69pY8EhFDz3x',
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}