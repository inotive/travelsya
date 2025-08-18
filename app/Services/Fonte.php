<?php

namespace App\Services;

use CURLFile;
use Exception;

class Fonte
{
    private $apiUrl = 'https://api.fonnte.com/send';
    private $token;

    public function __construct()
    {
        $this->token = config('services.fonnte.token', env('FONNTE_TOKEN'));
    }

    public function sendMessage($target, $message, $options = [])
    {
        try {
            $curl = curl_init();

            $postFields = array_merge([
                'target' => $target,
                'message' => $message,
                'schedule' => $options['schedule'] ?? 0,
                'typing' => $options['typing'] ?? false,
                'delay' => $options['delay'] ?? '2',
                'countryCode' => $options['countryCode'] ?? '62',
                'followup' => $options['followup'] ?? 0,
            ], $this->buildOptionalFields($options));

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->apiUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postFields,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $this->token
                ),
            ));

            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if (curl_errno($curl)) {
                throw new Exception('cURL Error: ' . curl_error($curl));
            }

            curl_close($curl);

            if ($httpCode !== 200) {
                throw new Exception('HTTP Error: ' . $httpCode . ' - ' . $response);
            }

            return [
                'success' => true,
                'data' => json_decode($response, true),
                'raw_response' => $response
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'data' => null
            ];
        }
    }

    private function buildOptionalFields($options)
    {
        $optionalFields = [];

        // Add URL if provided
        if (!empty($options['url'])) {
            $optionalFields['url'] = $options['url'];
        }

        // Add filename if provided
        if (!empty($options['filename'])) {
            $optionalFields['filename'] = $options['filename'];
        }

        // Add file if provided
        if (!empty($options['file'])) {
            if (is_string($options['file']) && file_exists($options['file'])) {
                $optionalFields['file'] = new CURLFile($options['file']);
            } elseif ($options['file'] instanceof CURLFile) {
                $optionalFields['file'] = $options['file'];
            }
        }

        // Add location if provided
        if (!empty($options['location'])) {
            $optionalFields['location'] = $options['location'];
        }

        return $optionalFields;
    }

    public function sendTextMessage($target, $message, $options = [])
    {
        return $this->sendMessage($target, $message, $options);
    }

    public function sendImageMessage($target, $message, $imagePath, $options = [])
    {
        $options['url'] = $imagePath;
        return $this->sendMessage($target, $message, $options);
    }

    public function sendFileMessage($target, $message, $filePath, $filename = null, $options = [])
    {
        $options['file'] = $filePath;
        if ($filename) {
            $options['filename'] = $filename;
        }
        return $this->sendMessage($target, $message, $options);
    }

    public function sendLocationMessage($target, $message, $latitude, $longitude, $options = [])
    {
        $options['location'] = $latitude . ', ' . $longitude;
        return $this->sendMessage($target, $message, $options);
    }
}
