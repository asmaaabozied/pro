<?php

namespace App\Helpers;

class Tracking{
    public static function add_to_track($order){
        // dd($order->total);
        $in = array(
            "AwbNumber" => "AGENT_AWBNUMBER",
            "ToCompany" => $order->user->name,
            "ToAddress" => $order->address->name,
            "ToLocation" => $order->address->city->name_en,
            "ToCountry" => $order->address->country->name_en,
            "ToCperson" => $order->user->name,
            "ToContactno" => $order->address->mobile,
            "ToMobileno" => $order->address->mobile,
            "ReferenceNumber" => "14125543634",
            "Weight" => strval($order->totalWeight()),  /* Decimal Only */
            "Pieces" => count($order->cart->items), /* Number Only */
            "PackageType" => "Parcel", /* (Document / Parcel ) - (International Documents / International N/Dox Up 30 KG)*/
            "CurrencyCode" => "AED",  /* Optaional - ISO 4217 Currency Codes */
            "NcndAmount" => $order->total + 0.01,
            "ItemDescription" => "description here",
            "SpecialInstruction" => "special instruction here",
            "BranchName" => "Dubai" 
        );

        $post_data = json_encode($in);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://portal.teamex.ae/webservice/CustomerBooking",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "API-KEY:69b778ab6fdb244904f3d69c22e31ed6",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return json_decode($response);
    }
}