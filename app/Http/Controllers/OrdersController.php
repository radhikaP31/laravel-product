<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoiceController;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdersController extends Controller
{
    /**
     * New Order of cart items
     * 
     */
    public function newOrder(Request $request){

        $user_id = Auth::user()->id;

        $cart_item = Cart::with(['user', 'product', 'inventory'])->where('is_deleted', 0)->where('status', 'pending')->where('user_id', $user_id)->get(); //get all cart items
        
        Cart::where('user_id', $user_id)->where('is_deleted', 0)->where('status', 'pending')->update(['is_deleted' => 0, 'status' => 'ordered']); //update cart item status

        //insert order
        $orders = new Orders;
        $orders->order_no = rand(10000, 99999);
        $orders->status = 'confirm';
        $order_result = $orders->save(); //add order

        $amount = 0;
        $tax = 0;
        $total_amount = 0;
        foreach($cart_item as $key => $item) {

            //insert order items
            $order_item = new OrderItem;
            $order_item->user_id = $user_id;
            $order_item->order_id = $orders->id;
            $order_item->product_id = $item->product_id;
            $order_item->quantity = $item->quantity;
            $item_result = $order_item->save();

            //deduct from inventory
            $left_quantity = $item->inventory['quantity'] - $item->quantity;
            Inventory::where('is_deleted', 0)->where('product_id', $item->product_id)->update(['quantity' => $left_quantity]); //decrese quantity from inventory

            $amount += $item->inventory['price'];
            $tax += $item->inventory['tax'] * $item->quantity;
            $total_amount += $item->total_price;
        }

        //create invoice
        $invoice = new Invoice();
        $invoice->user_id = $user_id;
        $invoice->order_id = $orders->id;
        $invoice->invoice_no = rand(10000, 99999);
        $invoice->amount = $amount;
        $invoice->tax = $tax;
        $invoice->total_amount = $total_amount;
        $invoice->status = 'unpaid';
        $invoice->result = $invoice->save();

        if ($invoice->result) {
            
            // Instantiate InvoiceController
            $invoice_obj = new InvoiceController();
            $pdfContent = $invoice_obj->createPdf($user_id, $cart_item, $orders->id, $invoice->id);

            $request->session()->flash('success', 'Order Place Successfully!! Please check you mail for details!!');

            return redirect('/dashboard');
    
        } else {

            $request->session()->flash('error', 'Oops.. Something went wrong. Please try again!');
            return redirect()->route('dashboard');
        }

    }

    public function downloadTest(){
        header("Content-type:application/pdf");

        $pdf = Pdf::loadView('invoice/invoicePdf', [
            'title' => 'Welcome to Tutsmake.com',
            'date' => date('m/d/Y')
        ]);
        return $pdf->download('invoice.pdf');
    }
}
