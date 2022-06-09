<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12 content">
                <table class="center">
                    <tbody>
                        <form method="post" action="/inventory/edit/{{ $inventory->id }}" enctype="multipart/form-data">
                            @csrf
                            <table>
                                <tbody>
                                    <tr>
                                        <td><label>Product:</label></td>
                                        <td>
                                            <input type="hidden" name="product_id" value="{{ $inventory->product_id }}" />
                                            <p>{{ $inventory->product['p_name'] }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Quantity:</label></td>
                                        <td><input type="text" name="quantity" value="{{ $inventory->quantity }}" />
                                            @error('quantity')
                                            <div class="text-red">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Tax:</label></td>
                                        <td><input type="text" name="tax" value="{{ $inventory->tax }}" />
                                            @error('tax')
                                            <div class="text-red">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Price:</label></td>
                                        <td><input type="text" name="price" value="{{ $inventory->price }}" />
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