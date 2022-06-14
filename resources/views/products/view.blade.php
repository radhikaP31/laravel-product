<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12 content">
                <h1>{{ $product->p_name }}</h1>
                <a href="/products" class="btn btn-primary-color float-right">Back</a>
                <a href="/dashboard" class="btn btn-primary-color float-right" style="margin-right: 5px;">Home</a>
                <table class="center">
                    <tbody>
                        <tr>
                            <td>Id</td>
                            <td><?= $product->id; ?></td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td><?= $product->p_name; ?></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><?= $product->p_description; ?></td>
                        </tr>
                        @if ($product->p_image && file_exists(public_path('storage/images/products/'.$product->p_image)))
                        <tr>
                            <td><label>Image:</label></td>
                            <td>
                                <a href="{{ asset('storage/images/products/'.$product->image) }}" target="_blank">
                                    <img src="{{ asset('storage/images/products/'.$product->p_image) }}" alt="{{$product->name}}" width="160px" height="100px" />
                                </a>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>