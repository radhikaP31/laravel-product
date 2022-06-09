<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container" style="margin:auto;">
            <div class="col-md-12 content">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <a href="/products/add" class="btn btn-primary-color float-right">New Product</a>
                <h3>Products</h3>
                @if(isset($products))
                <table class="center">
                    <thead>
                        <tr>
                            <th class="actions"><?= __('Actions') ?></th>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)

                        <tr>
                            <td>
                                <a href="/products/view/{{ $product->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-eye"></i></span>
                                </a>
                                <a href="/products/edit/{{ $product->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-pencil"></i></span>
                                </a>
                                <a href="/products/delete/{{ $product->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-trash"></i></span>
                                </a>
                            </td>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->p_name }}</td>
                            @if ($product->p_image && file_exists(public_path('storage/images/products/'.$product->p_image)))
                            <td>
                                <a href="{{ asset('storage/images/products/'.$product->p_image) }}" target="_blank">
                                    <img src="{{ asset('storage/images/products/'.$product->p_image) }}" alt="{{$product->p_name}}" width="160px" height="100px" />
                                </a>
                            </td>
                            @else
                            <td>
                                <img src="{{ asset('storage/images/no_image.png') }}" alt="{{$product->p_name}}" width="160px" height="100px" />
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 2%;">
                    {{$products->links()}}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>