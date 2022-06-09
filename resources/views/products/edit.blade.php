<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12 content">
                <table class="center">
                    <tbody>
                        <form method="post" action="/products/edit/{{ $product->id }}" enctype="multipart/form-data">
                            @csrf
                            <table>
                                <tbody>
                                    <tr>
                                        <td><label>Title:</label></td>
                                        <td><input type="text" name="name" value="{{ $product->p_name }}" />
                                            @error('name')
                                            <div class="text-red">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="description">Description:</label>
                                        </td>
                                        <td>
                                            <textarea name="description" rows="5">{{ $product->p_description }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Image:</label></td>
                                        <td><input type="file" name="image" value="" />
                                            @error('image')
                                            <div class="text-red">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    @if (file_exists(public_path('storage/images/products/'.$product->p_image)))
                                    <tr>
                                        <td><label>Old Image:</label></td>

                                        <td>
                                            <a href="{{ asset('storage/images/products/'.$product->p_image) }}" target="_blank">
                                                <img src="{{ asset('storage/images/products/'.$product->p_image) }}" alt="{{$product->p_name}}" width="160px" height="100px" />
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
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