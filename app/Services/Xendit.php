<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

class Xendit
{
    private $url, $apikey, $token, $header;

    public function __construct()
    {
        $this->url = 'https://api.xendit.co/';
        $this->apikey = config('xendit.API_KEY');
    }
    public function auth()
    {
        $userpass = $this->apikey . ":";
        $baseapi = base64_encode($userpass);
        return ['Authorization' => 'Basic ' . $baseapi, 'Content-Type' => 'application/json'];
    }
    public function create($data = [])
    {
        try {
            $client = new Client();

            $headers = $this->auth();
            $body = json_encode($data);
            // dd($body);
            $request = new Request('POST', $this->url . 'invoices', $headers, $body);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody(), TRUE);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), TRUE);
        }
    }
}
