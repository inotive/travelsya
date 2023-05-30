<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Mymili 
{
    protected $url, $requestid, $nom, $nohp, $msisdn, $pin, $headers, $method;

    public function __construct()
    {
        $this->url = 'http://180.250.247.166:6856/xmlh2h/';
        $this->requestid = 'H2H2712';
        $this->msisdn = '08115417708';
        $this->pin = '5614';
        $this->headers = [
            'Content-Type' => 'application/xml',
        ];

    }

    public function transaction($data)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
                    <methodCall>
                        <methodName>topUpRequest</methodName>
                        <params>
                            <param>
                                <value>
                                    <struct>
                                        <member>
                                            <name>MSISDN</name>
                                            <value>
                                                <string>'. $this->msisdn . '</string>
                                            </value>
                                        </member>
                                        <member>
                                            <name>REQUESTID</name>
                                            <value>
                                                <string>' . $this->requestid . '</string>
                                            </value>
                                        </member>
                                        <member>
                                            <name>PIN</name>
                                            <value>
                                                <string>' . $this->pin . '</string>
                                            </value>
                                        </member>
                                        <member>
                                            <name>NOHP</name>
                                            <value>
                                                <string>' . $data['nohp'] . '</string>
                                            </value> 
                                            Dawang API document 7 
                                        </member>
                                        <member>
                                            <name>NOM</name>
                                            <value>
                                                <string>' . $data['nom']. '</string>
                                            </value>
                                        </member>
                                    </struct>
                                </value>
                            </param>
                        </params>
                    </methodCall>';

        $client = New Client();
        try {
            $response = $client->request('POST', $this->url,  [
            'headers' => $this->headers,
            'body' => $xml ])->getBody()->getContents();
        } catch (ClientException $e) {
            $response = $e->getResponse()->getBody()->getContents();

        }

        return ResponseFormatter::namespacedXMLToArray($response);  

    }

    public function status($data)
    {
        $xml = '<?xml version="1.0"?> 
                    <methodCall>     
                        <methodName>topUpStatus</methodName>     
                            <params>         
                                <param>             
                                    <value>                 
                                        <struct>                     
                                            <member> 
                                                Dawang API document 10 
                                                <name>MSISDN</name>                         
                                                <value>                             
                                                    <string>' . $this->msisdn . '</string>                         
                                                </value>                     
                                            </member>                     
                                            <member>                         
                                                <name>REQUESTID</name>                         
                                                <value>                             
                                                    <string>' . $this->requestid . '</string>                         
                                                </value>                     
                                            </member>                     
                                            <member>                         
                                                <name>PIN</name>                         
                                                <value>                             
                                                    <string>' . $this->pin . '</string>                         
                                                </value>                     
                                            </member>                     
                                            <member>                         
                                                <name>NOHP</name>                         
                                                <value>                             
                                                    <string>' . $data['nohp'] . '</string>                         
                                                </value>                     
                                            </member>                     
                                            <member>
                                                <name>NOM</name>                         
                                                <value>                             
                                                    <string>' . $data['nom'] . '</string>                         
                                                </value>                     
                                            </member>                 
                                        </struct>             	
                                    </value>         
                                </param>     
                            </params> 
                    </methodCall>';

        $client = new Client();
        try {
            $response = $client->request('POST', $this->url,  [
                'headers' => $this->headers,
                'body' => $xml
            ])->getBody()->getContents();
        } catch (ClientException $e) {
            $response = $e->getResponse()->getBody()->getContents();
        }

        return ResponseFormatter::namespacedXMLToArray($response);              
    }
}