<?php

namespace App\Services;

use App\Helpers\ResponseFormatter;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;
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
                                                <string>' . $this->msisdn . '</string>
                                            </value>
                                        </member>
                                        <member>
                                            <name>REQUESTID</name>
                                            <value>
                                                <string>' . $data['reqid'] . '</string>
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
                                                <string>' . $data['no_hp'] . '</string>
                                            </value>
                                            Dawang API document 7
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
                                                    <string>' . $data['reqid'] . '</string>
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
                                                    <string>' . $data['no_hp'] . '</string>
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

    public function inquiry($data)
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
                                                <string>' . $this->msisdn . '</string>
                                            </value>
                                        </member>
                                        <member>
                                            <name>REQUESTID</name>
                                            <value>
                                                <string>' . time() . '</string>
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
                                                <string>' . $data['no_hp'] . '</string>
                                            </value>
                                            Dawang API document 7
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
            $responseRaw = $client->request('POST', $this->url,  [
                'headers' => $this->headers,
                'body' => $xml
            ])->getBody()->getContents();

            $responseArray = ResponseFormatter::namespacedXMLToArray($responseRaw);
            // dd(ResponseFormatter::namespacedXMLToArray($responseRaw));
            $messageArray = [];
            $message = [];
            if ($responseArray['RESPONSECODE'] == 00) {
                if ($data['nom'] == "CEKPLN") {
                    $message = explode("|", $responseArray['MESSAGE']);
                    $messageArray["status"] = $message[0];
                    $messageArray["tagihan"] = $message[1];
                    $messageArray["no_pelanggan"] = $message[2];
                    $messageArray["ref_id"] = $message[3];
                    $messageArray["nama_pelanggan"] = $message[4];
                    $messageArray["bulan_tahun_tagihan"] = $message[10];
                    $messageArray["pemakaian"] = explode(' ', $message[11])[0];
                } elseif ($data['nom'] == "CEKTELKOM") {
                    $message = explode("/", $responseArray['MESSAGE']);
                    $messageArray["status"] = $message[0];
                    $messageArray["nama_pelanggan"] = $message[1];
                    $messageArray["tagihan"] = $message[2];
                } elseif (str_contains($data['nom'], "CEKPDAM")) {
                    $message = explode(" ", $responseArray['MESSAGE']);
                    $messageArray["status"] = $message[3];
                    $messageArray["nama_pelanggan"] = explode("=", $message[7])[1];
                    $messageArray["tagihan"] = explode("=", $message[11])[1];
                } elseif ($data['nom'] == "CEKBPJSKS") {
                    $message = explode("/", $responseArray['MESSAGE']);
                    $messageArray["status"] = explode(" ", $message[0])[3];
                    $messageArray["nama_pelanggan"] = $message[1];
                    $messageArray["tagihan"] = explode(" ", $message[4])[0];
                } else {
                    $messageArray['status'] = 'NOM belum terdaftar';
                }
            } else {
                $messageArray['status'] = $responseArray['MESSAGE'];
            }

            $response = $messageArray;
        } catch (ClientException $e) {
            $responseRaw = $e->getResponse()->getBody()->getContents();

            $response = ResponseFormatter::namespacedXMLToArray($responseRaw);
        }

        return $response;
    }

    public function saldo()
    {
        $xml = '<?xml version="1.0"?>
        <methodCall>
         <methodName>checkBalance</methodName>
         <params>
         <param>
         <value>
         <struct>
         <member>
         <name>MSISDN</name>
         <value>
         <string>' . $this->msisdn . '</string>
         </value>
         </member>
         <member>
         <name>PIN</name>
         <value>
         <string>' . $this->pin . '</string>
         </value>
         </member>
         </struct>
         </value>
         </param>
         </params>
        </methodCall>
        ';

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
