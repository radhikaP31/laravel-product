<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Orders;
use App\Models\Invoice;
use App\Models\OrderItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class InvoiceController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        if (Auth::user()->role_id == 2) {

            $orders = Invoice::with(['users','orders'])
                ->where('user_id', $user_id)
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {

            $orders = Invoice::with(['users', 'orders'])
            ->orderBy('id', 'desc')
                ->paginate(10);
        }

        return view('invoice.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $user_id = Auth::user()->id;

        $invoice = Invoice::with(['users', 'orders'])->where('id', $id)->first();

        $order_item = OrderItem::with(['cart','user','product', 'inventory'])->where('order_id', $invoice->orders['id'])->get();

        return view('invoice.view', [
            'invoice' => $invoice,
            'order_item' => $order_item
        ]);
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
    {
        $user = User::findOrFail($user_id);

        $order_data = Invoice::with(['orders'])->where('is_deleted', 0)->where('order_id', $order_id)->where('id', $invoice_id)->first(); //get all cart items

        $data = [
            'cart_item' => $cart_item,
            'order_data' => $order_data,
            'user' => $user,
        ];

        $pdfContent = PDF::loadView('invoice/invoicePdf', $data);

        Storage::put('/public/invoice/'. $invoice_id . '_invoice.pdf', $pdfContent->output());
        
        if($user->email){

            //send order email
            $message = [
                'greeting' => 'Hi ' . $user->name . ',',
                'body' => 'This is the order confirmation notification.',
                'thanks' => 'Thank you for register!! You just order.Please refer attachment for invoice. Kindly share your review to us!! Hope You like our App:)',
                'actionText' => 'View Order',
                'actionURL' => url('/invoice/view/' . $order_id),
                'id' => $user_id,
                'attach_url' => storage_path('app/public/invoice/' . $invoice_id . '_invoice.pdf'),
                'attach_as' => $invoice_id . '_invoice.pdf',
                'attach_type' => 'application/pdf',
            ];
    
            $mail =  Notification::send($user, new OrderNotification($message));
        }

        return $pdfContent->download($invoice_id . '_invoice.pdf');
    }

    /**
     * change invoice status to Paid/Unpaid
     * @param $status string
     * @param $id number
     * @return dashboard
     * 
     */
    public function changeStatus(Request $request, $status='unpaid', $id) {

        // dd($_SERVER);
        Invoice::where('id', $id)->update(['status' => $status]);

        $request->session()->flash('success', 'Payment successful!!');

        return redirect()->route('invoice_index');
    }
}
