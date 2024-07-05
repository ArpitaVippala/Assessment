<?php

namespace App;

use Illuminate\Support\Facades\Http;

class Utils{

    public static function api_url(){
        $api_url = config('env-endpoint.API_URL');
        $api_key = config('env-endpoint.API_KEY');

        $headers = [
            'Authorization'=>'Bearer '.$api_key,
        ];

        return Http::withHeaders($headers)->baseUrl($api_url);
    }

    public static function getThisIpCountryCode($ipaddr){
        if(!empty($ipaddr)){
            $res = self::api_url()->get('ip/'.$ipaddr);
            if($res->successful() == 200){
                $response = json_decode($res->getBody());
                return $response->data;
            }else{
                return [];
            }
        }
    }
}