<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $id)
    {
        $this->user_id = Auth::user()->id;

        if ($request->method() == 'POST') {

            $validated = $request->validate([
                'quantity' => 'required',
            ]);

            if ($cart = Cart::where('user_id', $this->user_id)->where('product_id', $id)->where('status', 'pending')->where('is_deleted', 1)->first()) {

                $cart->quantity = $request->quantity;

                $price = $cart->quantity * $request->total_price;
                $cart->total_price = $price;

                $cart->user_id = $this->user_id;
                $cart->product_id = $id;
                $cart->status = 'pending';
                $cart->is_deleted = 0;
                $result = $cart->save();

            } else if( $cart = Cart::where('user_id', $this->user_id)->where('status', 'pending')->where('product_id', $id)->where('is_deleted', 0)->first()) {
                
                $cart->quantity = $cart->quantity + $request->quantity;

                $price = $cart->quantity * $request->total_price;
                $cart->total_price = $price;
                
                $cart->user_id = $this->user_id;
                $cart->product_id = $id;
                $cart->status = 'pending';
                $result = $cart->save();

            } else {

                $price = $request->quantity * $request->total_price;

                $cart = new Cart;
                $cart->quantity = $request->quantity;
                $cart->user_id = $this->user_id;
                $cart->product_id = $id;
                $cart->total_price = $price;
                $cart->status = 'pending';
                $result = $cart->save();

            }

            if ($result) {

                $request->session()->flash('success', 'Item Added to Cart!!');
                return redirect()->route('dashboard');
            } else {

                $request->session()->flash('error', 'Item not added. Please check!!');
                return redirect()->route('dashboard');
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function view(Cart $cart)
    {
        $user_id = Auth::user()->id;

        $cart_item = Cart::with(['user', 'product','inventory'])->where('is_deleted', 0)->where('status', 'pending')->where('user_id', $user_id)->get();

        return view('cart.view', [
            'cart_item' => $cart_item
        ]); 
    }

    /**
     * Show the form for editing the cart
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request)
    {
        $user_id = Auth::user()->id;

        $product_id = $request->product_id;

        $total_price = $request->quantity * $request->price;

        if(!$request->quantity) {
            $request->quantity = 1;
        }
        $left_quantity = Inventory::where('is_deleted', 0)->where('product_id', $product_id)->first();

        if($left_quantity->quantity >= $request->quantity){

            Cart::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('is_deleted', 0)
            ->where('status', 'pending')
            ->update(['quantity' => $request->quantity, 'total_price' => $total_price]);

            $total = Cart::join('inventory', 'cart.product_id', '=', 'inventory.product_id')
            ->select(Cart::raw("SUM(cart.total_price) as total_amount"), Cart::raw("SUM(cart.quantity) as total_quantity"))
            ->where('cart.is_deleted', 0)
            ->where('cart.status', 'pending')
            ->where('cart.user_id', $user_id)
            ->first();

            $result = ['total_amount' => $total->total_amount, 'total_quantity' => $total->total_quantity, 'success' => true];
            
        }else{
            
            $result = ['success' => false];
            
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function removeProduct(Request $request)
    {
        $user_id = Auth::user()->id;

        $product_id = $request->product_id;

        //delete item from cart
        Cart::where('user_id', $user_id)->where('product_id', $product_id)->where('is_deleted', 0)->where('status', 'pending')->update(['is_deleted' => 1]);

        //Update Inventory
        // $quantity = Inventory::select('quantity')->where('product_id', $product_id)->where('is_deleted', 0)->first();
        // Inventory::where('product_id', $product_id)->where('is_deleted', 0)->update(['quantity' => $quantity]);

        return true;
    }

}
