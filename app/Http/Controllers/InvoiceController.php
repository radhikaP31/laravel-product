<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Orders;
use App\Models\Invoice;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\EmailNotification;

class InvoiceController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Create PDF
     *
     * @param  \App\Models\Invoice  $invoice
     * @param  $cart_item array
     * @param  $orders_id integer
     * @param  $invoice_id integer
     * @return \Illuminate\Http\Response
     */
    public function createPDF($user_id, $cart_item, $order_id, $invoice_id)
    // public function createPDF($cart_item, $orders_id, $invoice_id)
    {
        $user = User::findOrFail($user_id);

        $order_data = Invoice::with(['orders'])->where('is_deleted', 0)->where('order_id', $order_id)->where('id', $invoice_id)->first(); //get all cart items

        $data = [
            'cart_item' => $cart_item,
            'order_data' => $order_data,
            'user' => $user,
        ];

        //send order email
        $message = [
            'greeting' => 'Hi ' . $user->name . ',',
            'body' => 'This is the order confirmation notification.',
            'thanks' => 'Thank you for register!! You just order.Please refer attechment for invoice.Kindly share your review to us!! Hope You like our App:)',
            'actionText' => 'View Order',
            'actionURL' => url('/orders/view/' . $order_id),
            'id' => $user_id
        ];
        Notification::send($user, new EmailNotification($message));
        
        $pdfContent = PDF::loadView('invoice/invoicePdf', $data);

        return $pdfContent->download($invoice_id . '_invoice.pdf');

    }
}
