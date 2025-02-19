<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use GuzzleHttp\Client;
use Validator;



class PaymentController extends Controller
{
    public function createTransaction(Request $request)
    {
        Config::$serverKey = env("MIDTRANS_SERVER_KEY");
        ;
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => $request->transaction_details,
            'customer_details' => $request->customer_details,
            'item_details' => $request->item_details,
        ];

        try {
            $snapToken = Snap::getSnapUrl($params);
            dd($snapToken);
            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createAPITransaction(Request $d)
    {
        $validator = Validator::make($d->all(), [
            'payment_type' => 'required|string',
            'transaction_details' => 'required|array',
            'transaction_details.order_id' => 'required|string',
            'transaction_details.gross_amount' => 'required|numeric',
            'customer_details' => 'required|array',
            'customer_details.first_name' => 'required|string',
            'customer_details.email' => 'required|email',
            'custom_expiry' => 'nullable|array',
            'custom_expiry.start_time' => 'nullable|date_format:Y-m-d H:i:s',
            'custom_expiry.duration' => 'nullable|integer',
            'custom_expiry.unit' => 'nullable|in:minute,hour,day',
            'metadata' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ], 400);
        }

        $client = new Client();

        try {
            $response = $client->request('POST', 'https://api.sandbox.midtrans.com/v2/charge', [
                'json' => [
                    'payment_type' => $d->payment_type,
                    'transaction_details' => $d->transaction_details,
                    'customer_details' => $d->customer_details,
                    'custom_field1' => $d->custom_field1,
                    'custom_field2' => $d->custom_field2,
                    'custom_field3' => $d->custom_field3,
                    'custom_expiry' => $d->custom_expiry,
                    'metadata' => $d->metadata
                ],
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic ' . env("AUTHORIZATION_MIDTRANS"),
                    'content-type' => 'application/json',
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            $jsonData = json_encode($body, JSON_PRETTY_PRINT);
            file_put_contents(storage_path('app/transaction.json'), $jsonData);
            return response()->json($body);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()   
            ], 500);
        }
    }

    public function handleWebhook(Request $request)
    {
        Config::$serverKey = env("MIDTRANS_SERVER_KEY");
        Config::$isProduction = false;

        $notif = new Notification();

        $orderId = $notif->order_id;
        $grossAmount = $notif->gross_amount;
        $status = $notif->status_code;
        $signature = $notif->signature_key;
        $serverKey = env("MIDTRANS_SERVER_KEY");

        if ($status != 200) {
            return response()->json([
                "message" => $notif->status_message
            ], $status);
        }

        $mySignature = hash('sha512', $orderId + $status + $grossAmount + $serverKey);

        if ($mySignature != $signature) {
            return response()->json([
                'message' => "Signature is not match"
            ], 403);
        }

        $jsonData = json_encode($notif->getResponse(), JSON_PRETTY_PRINT);
        file_put_contents(storage_path('app/midtrans_webhook.json'), $jsonData);
        return response()->json([
            'message' => 'Webhook processed and saved'
        ], 200);
    }
}
