<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::with('product')->orderBy('id', 'desc')->paginate(5);
        return view('inventory.index', [
            'inventories' => $inventory
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        if ($request->method() == 'POST') {

            $validated = $request->validate([
                'product_id' => 'required',
                'quantity' => 'required|integer',
                'price' => 'required|numeric',
            ]);

            $inventory = new Inventory();
            $inventory->product_id = $request->product_id;
            $inventory->quantity = $request->quantity;
            $inventory->price = $request->price;
            $inventory->total_price = (float)$request->tax + (float)$request->price;
            $inventory->tax = $request->tax;
            $result = $inventory->save();

            if ($result) {

                $request->session()->flash('success', 'Inventory saved!!');
                return redirect()->route('inventory_index');
            } else {

                $request->session()->flash('error', 'Inventory not saved. Please check!!');
                return redirect()->route('inventory_index');
            }
        } else {

            $products = DB::table('products')
                ->whereNotIn('id', DB::table('inventory')->select('product_id')->get()->pluck('product_id')->toArray())
                ->get();

            return view('inventory.add', [
                'products' => $products
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        return view('inventory.view', [
            'inventory' => Inventory::with('product')->findOrFail($id)
        ]);
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $inventory = Inventory::with('product')->findOrFail($id);

        if ($request->method() == 'POST') {

            $validated = $request->validate([
                'product_id' => 'required',
                'quantity' => 'required|integer',
                'price' => 'required|numeric',
            ]);

            $inventory->product_id = $request->product_id;
            $inventory->quantity = $request->quantity;
            $inventory->price = $request->price;
            $inventory->tax = $request->tax;
            $inventory->total_price = (float)$request->tax + (float)$request->price;
            $result = $inventory->save();

            if ($result) {

                $request->session()->flash('success', 'Inventory updated!!');
                return redirect()->route('inventory_index');
            } else {

                $request->session()->flash('error', 'Inventory not updated. Please check!!');
                return redirect()->route('inventory_index');
            }
        } else {

            return view('inventory.edit', [
                'inventory' => $inventory,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {

        $inventory = Inventory::find($id);
        $status = $inventory->delete();

        $request->session()->flash('success', 'Inventory deleted!!');

        return redirect()->route('inventory_index');
    }
}
