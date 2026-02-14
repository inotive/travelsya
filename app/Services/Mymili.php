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
        $this->url = 'http://180.250.247.166:6856/xmlh2h/v2/';
        $this->requestid = 'H2H2712';
        $this->msisdn = '08115417708';
        $this->pin = '5614';
        $this->headers = [
            'Content-Type' => 'application/xml',
        ];

    }

    public function paymentTopUp($invoice, $kodePembayaran, $nomorTopUp)
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
                                                <string>' . $invoice . '</string>
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
                                                <string>' . $nomorTopUp . '</string>
                                            </value>
                                            Dawang API document 7
                                        </member>
                                        <member>
                                            <name>NOM</name>
                                            <value>
                                                <string>' . $kodePembayaran . '</string>
                                            </value>
                                        </member>
                                    </struct>
                                </value>
                            </param>
                        </params>
                    </methodCall>';

        $client = new Client();
        try {
            $response = $client->request('POST', $this->url, [
                'headers' => $this->headers,
                'body' => $xml
            ])->getBody()->getContents();
        } catch (ClientException $e) {
            $response = $e->getResponse()->getBody()->getContents();
        }

        return ResponseFormatter::namespacedXMLToArray($response);
    }
    public function paymentPPOB($invoice, $kodePembayaran, $nomorTagihan)
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
                                                <string>' . $invoice . '</string>
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
                                                <string>' . $nomorTagihan . '</string>
                                            </value>
                                            Dawang API document 7
                                        </member>
                                        <member>
                                            <name>NOM</name>
                                            <value>
                                                <string>' . $kodePembayaran . '</string>
                                            </value>
                                        </member>
                                    </struct>
                                </value>
                            </param>
                        </params>
                    </methodCall>';

        $client = new Client();
        try {
            $response = $client->request('POST', $this->url, [
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
            $response = $client->request('POST', $this->url, [
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
            $responseRaw = $client->request('POST', $this->url, [
                'headers' => $this->headers,
                'body' => $xml
            ])->getBody()->getContents();

            // dd($responseRaw);
            $responseArray = ResponseFormatter::namespacedXMLToArray($responseRaw);
            $messageArray = [];
            $message = [];
            if ($responseArray['RESPONSECODE'] == 00) {
                if ($data['nom'] == "CEKPLN") {
                    $pattern = '/SN=(.+?)\[Produk:/s';

                    // Apply the pattern to the string
                    if (preg_match($pattern, $responseArray['MESSAGE'], $matches)) {
                        // Extracted SN portion
                        $snPortion = $matches[1];

                        // Split the SN portion by the pipe character
                        $snValues = explode('|', $snPortion);
                        $messageArray["status"] = "SUKSES";
                        $messageArray["tagihan"] = $snValues[1] ?? $message[1];
                        $messageArray["no_pelanggan"] = $snValues[2] ?? $message[2];
                        $messageArray["ref_id"] = $snValues[3] ?? $message[3];
                        $messageArray["nama_pelanggan"] = $snValues[4] ?? $message[4];

                        $month = "";
                        if (preg_match('/\b(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\b/i', $snValues[10], $matches)) {
                            $month = $matches[1];

                        } else {

                            $month = "Unknown";

                        }
                        $messageArray["bulan_tahun_tagihan"] = $month;
                        //$messageArray["pemakaian"] = explode(' ', $message[10][0]);
                        // Output the result

                    } else {
                        $message = explode("|", $responseArray['MESSAGE']);
                        $messageArray["status"] = $message[0];
                        $messageArray["tagihan"] = $message[1];
                        $messageArray["no_pelanggan"] = $message[2];
                        $messageArray["ref_id"] = $message[3];
                        $messageArray["nama_pelanggan"] = $message[4];
                        $messageArray["bulan_tahun_tagihan"] = $message[10];
                        //$messageArray["pemakaian"] = explode(' ', $message[10])[0];
                    }

                } elseif ($data['nom'] == "CEKTELKOM") {
                    $message = explode("/", $responseArray['MESSAGE']);
                    $messageArray["status"] = $message[0];
                    $messageArray["nama_pelanggan"] = $message[1];
                    $messageArray["tagihan"] = $message[2];
                } elseif (str_contains($data['nom'], "CEKPDAMBLP")) {
                    $message = explode(" ", $responseArray['MESSAGE']);
                    $patterns = [
                        '/SN=(\S+)/',                  // Matches SN=SUKSES
                        '/TAG (\S+)/',                 // Matches TAG PDAMBLP
                        '/AN=(\S+)/',                  // Matches AN=xxxxx
                        '/RP=(\d+)/',                  // Matches RP=xxxxx
                        '/ADM=(\d+)/',                 // Matches ADM=xxxxx
                        '/TOT=(\d+)/',                 // Matches TOT=xxxxx
                        '/Nama:(\S+\s+\S+\s+\S+)/',   // Matches Nama:xxxxxx
                        '/Total Tagihan:(\d+)/',       // Matches Total Tagihan:27282
                    ];

                    $matches = [];

                    foreach ($patterns as $pattern) {
                        if (preg_match($pattern, $responseArray['MESSAGE'], $match)) {
                            $matches[] = $match[1];
                        }
                    }
                    $namaPelanggan = '';
                    if (strpos($matches[6] ?? $matches[2], ';') !== false) {
                        // Split the string by semicolon
                        $parts = explode(';', $matches[6] ?? $matches[2]);

                        // Take the first part
                        $namaPelanggan = $parts[0];
                    } else {
                        // If no semicolon, take the entire string
                        $namaPelanggan = $matches[6] ?? $matches[2];
                    }

                    $messageArray["status"] = $matches[0] ?? null;
                    $messageArray["nama_pelanggan"] = $namaPelanggan;
                    $messageArray["tagihan"] = $matches[5] ?? null;

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
            $response = $client->request('POST', $this->url, [
                'headers' => $this->headers,
                'body' => $xml
            ])->getBody()->getContents();
        } catch (ClientException $e) {
            $response = $e->getResponse()->getBody()->getContents();
        }

        return ResponseFormatter::namespacedXMLToArray($response);
    }
}
