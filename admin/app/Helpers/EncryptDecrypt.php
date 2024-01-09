<?php
namespace App\Helpers;

use App;
use Illuminate\Http\Request;

class EncryptDecrypt
{
    public static function bodyEncrypt($string)
    {

        $encryptionMethod = "AES-256-CBC";
        $secret = hash('sha256', 'y3FBUk4mXb87VP0qkh2eQPCEpmuk0Jfk'); //must be 32 char length
        $iv = 'y3FBUk4mXb87VP0q';
        $encryptValue = openssl_encrypt($string, $encryptionMethod, $secret, 0, $iv);

        return $encryptValue;
    }
    public static function bodyDecrypt($string)
    {

        $encryptionMethod = "AES-256-CBC";
        $secret = hash('sha256', 'y3FBUk4mXb87VP0qkh2eQPCEpmuk0Jfk'); //must be 32 char length
        $iv = 'y3FBUk4mXb87VP0q';

        $decryptValue = openssl_decrypt($string, $encryptionMethod, $secret, 0, $iv);

        return $decryptValue;

    }
    public static function requestDecrypt($request, $type = '')
    {
        if (!empty($type) &&  $type == 'api-key') {
            return self::bodyDecrypt($request);
        }
        $data = (array) json_decode(self::bodyDecrypt($request));

        return new Request($data);
    }
}
