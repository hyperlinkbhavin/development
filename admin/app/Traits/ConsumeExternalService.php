<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\Helpers\EncryptDecrypt;
use Illuminate\Support\Facades\Session;

trait ConsumeExternalService 
{

    /**
     * Send a request to any external service
     * @param $method
     * @param $requestUri
     * @param array $formParams
     * @param array $headers
     * @param bool $async
     * @param bool $is_auth
     * @return String
     * @throws GuzzleException
     */
    public function performRequest($method, $requestUri, $formParams='', array $headers=[], bool $async=false): string
    {

        $client = new Client([
            'base_uri' => env('BASE_URI_FOR_API'),
        ]);

        $header_name = env('HEADER_NAME');
    
        $headers[$header_name] = env('HEADER_KEY');
        // $headers['Accept'] = 'text/plain';
        $headers['Content-Type'] = 'text/plain';
        // $headers['accept_language']=!empty(Session::get('USER_LANGUAGE_SESSION'))?Session::get('USER_LANGUAGE_SESSION')['abbr']:'en';
        // $headers['accept_language']='en';
        $response = "";
        if($async) {
            $promise = $client->requestAsync($method, $requestUri, ['verify' => false,'http_errors'=>false,'body' => $formParams, 'headers' => $headers]);
            $response = $promise->wait();
            $promise->then(
                function (ResponseInterface $res) {
                    $response = $res->getBody()->getContents();
                },
                function (RequestException $exception) {
                    $response = $exception->getMessage();
                });
        }else{
            if($method=='GET')
            {
                // die('hello');
                // $response = $client->request($method,  $requestUri.'?'.http_build_query($formParams), ['verify' => false,'http_errors'=>false,'body' => $formParams, 'headers' => $headers]);
                $response = $client->request($method,  $requestUri, ['verify' => false,'http_errors'=>false,'body' => $formParams, 'headers' => $headers]);
                $response = $response->getBody()->getContents();
            }
            else
            {
                if(empty($headers))
                {
                    die('hello');
                }
                $response = $client->request($method, $requestUri, ['verify' => false,'http_errors'=>false,'body' => $formParams, 'headers' => $headers]);
            // echo "<pre>hello";print_r($response->getBody()->getContents());die;

                // if($response->getStatusCode()== 401 || $response->getStatusCode()=='401')
                // {
                //  Session::forget('USER_LOGIN_SESSION');
                //  Session::save();
                //  return redirect()->route('home');
                // }  
             $response = $response->getBody()->getContents();
         }
     }
     return $response;
 }
}
