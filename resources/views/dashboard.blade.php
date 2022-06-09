<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="container row col-md-12">
        @foreach($products as $key => $product)
        <div class="col-md-3">
            <div class="card">
                @if ($product->p_image && file_exists(public_path('storage/images/products/'.$product->p_image)))

                <a href="{{ asset('storage/images/products/'.$product->p_image) }}" target="_blank" class="product_image">
                    <img src="{{ asset('storage/images/products/'.$product->p_image) }}" alt="{{$product->name}}" width="160px" height="100px" style="margin:auto" />
                </a>

                @endif
                <div class="card-body">
                    <h5 class="card-title"><?= $product->p_name; ?></h5>

                    <ul class="list-group list-group-flush">
                        <p class="card-text"><?= $product->p_description; ?></p>

                        <li class="list-group-item">
                            <?= isset($product->inventory['price']) ? $product->inventory['price'] : 'FREE';  ?>
                            <small> + <?= isset($product->inventory['tax']) ? $product->inventory['tax'] : '0rs.';  ?>(Tax)
                            </small>
                        </li>
                    </ul>
                    <br>
                    <div class="product_action">
                        <a href="/products/view/{{$product->id}}" class="btn btn-primary-color card-link" target="_blank">View</a>
                        <a href="/cart/add/{{$product->id}}" class="btn btn-primary-color card-link">Add to Cart</a>
                    
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>