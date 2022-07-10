<?php 

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use App\Services\FileService;
use Illuminate\Support\Facades\Storage;

class GcpService
{
    public function postOcrPdf($file)
    {
        $client = new Client();
        $FileService = new FileService;
        $payloads = [
            [
                'name' => 'pdf',
                'contents' => Storage::disk('local')->get($FileService->path($file->filename)),
                'filename' => basename($file->filename),
            ]
        ];
        try {
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . Config::get('gcp.token'),
                'webhook_url' => 'https://webhook.site/678f497a-6cfa-4afa-b389-d9b81f496be1'
            ];
            $res = $client->request('POST', 'https://picaso.id/api/order/v1.2/ocr', [
                'headers' => $headers,
                'http_errors' => false,
                'defaults' => [
                    'verify' => false,
                ],
                'multipart' => $payloads
            ]);
            $res_body = json_decode($res->getBody(), true);
            if ($res->getStatusCode() == 200) {
                $FileService->update($file->id,[
                    'gcp_code' => $res_body['transaction_id'],
                    'ocr_response' => $res_body
                ]);
                return [
                    'success' => true,
                    'message' => 'Proses OCR berhasil dikirim dengan id transaksi '.$res_body['transaction_id'],
                ];
            }
            return [
                'success' => false,
                'message' => $res_body['message'],
            ];
        } catch (\Throwable $th) {
            Log::error([
                'action' => 'ocr_process id:'.$file->id,
                'error' => $th
            ]);
            return [
                'success' => false,
                'message' => $th->getMessage(),
            ];
        }    
    }
}
