<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

class Travelsya
{
    private $url, $apikey, $token;

    public function __construct()
    {
        $this->url = 'https://demoz4ghel.my.id/api/';
    }
    public function auth()
    {
        if (session()->get('user')) {
            return ['Authorization' => session()->get('user')['token'], 'Content-Type' => 'application/json'];
        } else {
            return ['Content-Type' => 'application/json'];
        }
    }
    public function login($data = [])
    {
        try {
            $client = new Client();

            $headers = $this->auth();
            $body = json_encode($data);
            $request = new Request('POST', $this->url . 'login', $headers, $body);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function logout()
    {
        try {
            $client = new Client();

            $headers = $this->auth();
            $request = new Request('POST', $this->url . 'logout', $headers);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function register($data = [])
    {
        try {
            $client = new Client();

            $headers = $this->auth();
            $body = json_encode($data);
            $request = new Request('POST', $this->url . 'register', $headers, $body);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function tokenEmail($data = [])
    {
        try {
            $client = new Client();

            $headers = $this->auth();
            $body = json_encode($data);
            $request = new Request('POST', $this->url . 'send-token-password', $headers, $body);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function resetPassword($data = [])
    {
        try {
            $client = new Client();

            $headers = $this->auth();
            $body = json_encode($data);
            $request = new Request('POST', $this->url . 'reset-password', $headers, $body);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function pricelist()
    {
        try {
            $client = new Client();
            $headers = $this->auth();
            $request = new Request('get', $this->url . 'ppob', $headers);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function pricelistId($id)
    {
        try {
            $client = new Client();
            $headers = $this->auth();
            $request = new Request('get', $this->url . 'ppob/' . $id, $headers);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function requestPpob($data = [])
    {
        try {
            $client = new Client();
            $headers = $this->auth();
            $body = json_encode($data);
            $request = new Request('post', $this->url . 'ppob/transaction/request', $headers, $body);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function listTransaction()
    {
        try {
            $client = new Client();
            $headers = $this->auth();
            $request = new Request('post', $this->url . 'transaction/user', $headers);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function detailTransaction($no_inv)
    {
        try {
            $client = new Client();
            $headers = $this->auth();
            $request = new Request('post', $this->url . 'transaction/invoice?no_inv=' . $no_inv, $headers);
            $res = $client->sendAsync($request)->wait();
            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }
}
