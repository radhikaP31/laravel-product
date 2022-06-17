<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);

        return view('products.index', [
            'products' => $products
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
                'name' => 'required|max:255',
                'description' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                ]);
                
            $products = new Product();
            $products->p_name = $request->name;
            $products->p_description = $request->description;
            $products->p_image = $_FILES['image']['name'];
            $result = $products->save();

            if ($request->hasFile('image')) {

                //upload profile picture
                $imageName = $products->id . '_' . $request->image->getClientOriginalName();
                $request->image->storeAs('public/images/products', $imageName);

                $p_data = Product::find($products->id);
                $p_data->p_image = $imageName;
                $result = $p_data->save();
            }

            if ($result) {

                $request->session()->flash('success', 'Product saved!!');
                return redirect()->route('products_index');

            } else {

                $request->session()->flash('error', 'Product not saved. Please check!!');
                return redirect()->route('products_index');
            }
        } else {

            return view('products.add');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        return view('products.view', [
            'product' => Product::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $products = Product::findOrFail($id);

        if ($request->method() == 'POST') {

            $validated = $request->validate([
                'name' => 'required|max:255',
                'description' => 'required|max:255',
            ]);

            $products->p_name = $request->name;
            $products->p_description = $request->description;
            $result = $products->save();

            if ($request->hasFile('image')) {

                //upload profile picture
                $imageName = $id . '_' . $request->image->getClientOriginalName();
                $request->image->storeAs('public/images/products', $imageName);

                $product_data = Product::find($id);
                $product_data->image = $imageName;
                $result = $product_data->save();
            }

            if ($result) {

                $request->session()->flash('success', 'Product updated!!');
                return redirect()->route('products_index');
            } else {

                $request->session()->flash('error', 'Product not updated. Please check!!');
                return redirect()->route('products_index');
            }
        } else {

            return view('products.edit', [
                'product' => $products
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {

        $products = Product::find($id);
        $status = $products->delete();

        $request->session()->flash('success', 'Product deleted!!');

        return redirect()->route('products_index');
    }

    /**
     * Display all products list on dashboard
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function productList(Request $request)
    {

        $products = Product::with('inventory')->get();

        return view('dashboard', [
            'products' => $products
        ]);

    }


}
