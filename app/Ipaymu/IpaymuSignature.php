<?php

namespace App\Ipaymu;

class IpaymuSignature
{
    public static function signature(array $options)
    {
        $jsonBody     = json_encode($options , JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        
        $stringToSign = strtoupper('POST') . ':' . env('IPAYMU_VA') . ':' . $requestBody . ':' . env('IPAYMU_API_KEY');
        $signature    = hash_hmac('sha256', $stringToSign, env('IPAYMU_API_KEY'));

        return $signature;
    }
}