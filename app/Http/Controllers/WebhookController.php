<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    
    public function stripeWebhook(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/webhook.log'),
        ])->info('Webhook run yo');

        http_response_code(200);
    }
}
