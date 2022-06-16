<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block  container mb-3">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif

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

                        <p class="card-text">{{ Str::limit($product->p_description, 50) }}</p>

                        <li class="list-group-item">
                            <?= isset($product->inventory['price']) ? $product->inventory['price'] : 'FREE';  ?>
                            <small> + <?= isset($product->inventory['tax']) ? $product->inventory['tax'] : '0rs.';  ?>(Tax)
                            </small>
                        </li>
                        <li class="list-group-item">
                            <p name="error" class="qty-error-{{$product->id}}" style="    height: 25px;"></p>
                            <form method="post" action="/cart/add/{{$product->id}}" enctype="multipart/form-data">
                                @csrf
                                <input type="number" step="1" min="1" max="{{$product->inventory['quantity']}}" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="" style="width: 40%;height: 0%;" data-product_id="{{$product->id}}" data-qty="{{$product->inventory['quantity']}}">
                                <input type="hidden" name="total_price" value="{{$product->inventory['total_price']}}">
                                <button type="submit" class="btn btn-primary-color submit-{{$product->id}}">Add to Cart</button>
                            </form>

                        </li>
                    </ul>
                    <br>
                    <div class="product_action">


                    </div>
                    <div class="product_action">
                        <a href="/products/view/{{$product->id}}" class="btn btn-primary-color card-link" target="_blank">View</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>