<?php
 
namespace App\Http\Controllers;

use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;
use Stripe;
 
class StripeController extends Controller
{
    public function payStripe($id)
    {
        $stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $invoice = Invoice::where('id', $id)->first();

        try {
            $session = Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'shipping_address_collection' => [
                    'allowed_countries' => ['IN'],
                ],
                'shipping_options' => [
                    [
                        'shipping_rate_data' => [
                            'type' => 'fixed_amount',
                            'fixed_amount' => [
                                'amount' => 0,
                                'currency' => 'inr',
                            ],
                            'display_name' => 'Free shipping',
                            // Delivers between 5-7 business days
                            'delivery_estimate' => [
                                'minimum' => [
                                    'unit' => 'business_day',
                                    'value' => 5,
                                ],
                                'maximum' => [
                                    'unit' => 'business_day',
                                    'value' => 7,
                                ],
                            ]
                        ]
                    ],
                    [
                        'shipping_rate_data' => [
                            'type' => 'fixed_amount',
                            'fixed_amount' => [
                                'amount' => 0,
                                'currency' => 'inr',
                            ],
                            'display_name' => 'Next day air',
                            // Delivers in exactly 1 business day
                            'delivery_estimate' => [
                                'minimum' => [
                                    'unit' => 'business_day',
                                    'value' => 1,
                                ],
                                'maximum' => [
                                    'unit' => 'business_day',
                                    'value' => 1,
                                ],
                            ]
                        ]
                    ],
                ],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'inr',
                        'product_data' => [  
                            'name' => 'E-cart',
                        ],
                        'unit_amount' => $invoice->total_amount*100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'http://laravel.training/invoice/changeStatus/paid/'.$invoice->id,
                // 'success_url' => 'http://laravel.training/stripeWebhook',
                'cancel_url' => 'http://laravel.training/dashboard',
            ]);

            return redirect($session['url']);
        
        } catch (Exception $e) {
            return $e->getMessage();
        }
 
 
    }
}
