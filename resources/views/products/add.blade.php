<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12 content">
                <h3>Create Product</h3>
                <table class="center">
                    <tbody>
                        <form method="post" action="/products/add" enctype="multipart/form-data">
                            @csrf
                            <table>
                                <tbody>
                                    <tr>
                                        <td><label>Title:</label></td>
                                        <td><input type="text" name="name" value="{{ old('name') }}" />
                                            @error('name')
                                            <div class="text-red">{{ $message }}</div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label for="description">Description</label>
                                        </td>
                                        <td>
                                            <textarea name="description" rows="5">{{ old('description') }}</textarea>
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