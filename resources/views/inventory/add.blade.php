<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12 content">
                <h3>Create Inventory</h3>
                <table class="center">
                    <tbody>
                        <form method="post" action="/inventory/add" enctype="multipart/form-data">
                            @csrf
                            <table>
                                <tbody>
                                    <tr>
                                        <td><label>Product:</label></td>
                                        <td>
                                            <select name="product_id">
                                                <option value="">Select an Option</option>
                                                @foreach($products as $product)

                                                <option value="{{ $product->id }}" {{ (old("product_id") == $product->id ? "selected":"") }}>{{ $product->p_name }}</option>

                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Quantity:</label></td>
                                        <td><input type="text" name="quantity" value="{{ old('quantity') }}" />
                                            @error('quantity')
                                            <div class="text-red">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Tax:</label></td>
                                        <td><input type="text" name="tax" value="{{ old('tax') }}" />
                                            @error('tax')
                                            <div class="text-red">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Price:</label></td>
                                        <td><input type="text" name="price" value="{{ old('price') }}" />
                                            @error('price')
                                            <div class="text-red">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: center;">
                                            <button type="submit" class="btn btn-primary-color">Submit</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>