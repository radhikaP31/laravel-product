<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12 content">
                <h1>
                    Shopping Cart
                    <a href="/dashboard" class="btn btn-primary-color float-right" style="margin-right: 5px;">Home</a>
                </h1>
                <br><br>

                @if($cart_item->count() > 0)

                <div class="CartContainer">

                    <?php
                    $total = 0;
                    $total_quantity = 0;
                    ?>
                    <div class="Cart-Items heading">
                        <div class="image-box">Image</div>
                        <div class="about" style="width: 10%;">Name</div>
                        <div class="about" style="width: 0%;">Price</div>
                        <div class="counter" style="width: 1%;">Quantity</div>
                        <div class="prices" style="width: 10%;">Total Amount</div>
                    </div>
                    @foreach($cart_item as $key => $item)

                    <?php $grand_total = $item->inventory['total_price'] * $item->quantity ?>

                    <div class="Cart-Items">
                        <div class="image-box">
                            <a href="{{ asset('storage/images/products/'.$item->product['p_image']) }}" target="_blank" class="product_image">
                                <img src="{{ asset('storage/images/products/'.$item->product['p_image']) }}" alt="{{$item->product['p_name']}}" width="120px" height="100px" style="margin:auto" />
                            </a>
                        </div>
                        <div class="about">
                            <a href="/products/view/{{$item->product['id']}}" target="_blank">
                                <h1 class="title">{{ $item->product['p_name']}}</h1>
                            </a>

                            <p>{{ Str::limit($item->product['p_description'], 30) }}</p>
                        </div>
                        <div class="about">
                            <div class="">
                                {{ number_format($item->inventory['price'], 2, '.', ','); }} <br><small> + Tax: {{ number_format($item->inventory['tax'], 2, '.', ','); }}</small>
                            </div>
                        </div>
                        <div class="counter">
                            <input type="number" step="1" min="1" max="" name="cart_quantity" value="{{$item->quantity}}" title="Qty" class="input-text qty text cart_quantity" size="4" style="height: 0%;width: 90%;" data-price="{{$item->inventory['total_price']}}" data-product_id="{{$item->product['id']}}">
                        </div>
                        <div class="prices">
                            <div class="amount amount-{{$item->product['id']}}">
                                {{ number_format($grand_total, 2, '.', ','); }}
                            </div>
                            <div class="remove" data-product_id="{{$item->product['id']}}"><u>Remove</u></div>
                        </div>
                    </div>
                    <?php
                    $total += $grand_total;
                    $total_quantity += $item->quantity;
                    ?>
                    @endforeach
                    <hr>
                    <div class="row col-md-12">
                        <div class="col-md-7"></div>
                        <div class="col-md-5 checkout" style="padding: 0px 5%;">
                            <div class="total">
                                <div>
                                    <div class="Subtotal">Sub-Total: </div>
                                    <div class="items total-quantity">Total Cart Item(s): {{ $total_quantity }}</div>
                                </div>
                                <div class=" total-amount">{{ number_format($total, 2, '.', ','); }}</div>
                            </div>
                            <form method="post" action="/orders/order" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" class="button btn btn-primary-color" >Place Order</button>
                            </form>

                        </div>
                    </div>
                    <div></div>
                </div>

                @else

                <div>
                    <h3> No Items in cart for now. <a href="/dashboard" style="text-decoration-line: underline; font-weight: 600;"> Click here to Continue Shopping!! </a> </h3>
                </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .counter>.btn {
        border-radius: unset;
    }

    .Cart-Items {
        width: 90%;
        height: 30%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .image-box {
        width: 15%;
        text-align: center;
    }

    .about {
        height: 100%;
    }

    .title {
        padding-top: 5px;
        font-weight: 800;
        color: #202020;
    }

    .counter {
        width: 15%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .count {
        font-size: 20px;
        font-family: ‘Open Sans’;
        font-weight: 900;
        color: #202020;
    }

    .prices {
        height: 100%;
        text-align: right;
    }

    .amount {
        padding-top: 20px;
        font-size: 16px;
        font-family: ‘Open Sans’;
        font-weight: 800;
        color: #202020;
    }

    .save {
        padding-top: 5px;
        font-size: 14px;
        font-family: ‘Open Sans’;
        font-weight: 600;
        color: #1687d9;
        cursor: pointer;
    }

    .remove {
        padding-top: 5px;
        font-size: 14px;
        font-family: ‘Open Sans’;
        font-weight: 600;
        color: #E44C4C;
        cursor: pointer;
    }

    hr {
        width: 66%;
        float: right;
        margin-right: 5%;
    }

    .total {
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .Subtotal {
        font-size: 22px;
        font-family: ‘Open Sans’;
        font-weight: 700;
        color: #202020;
    }

    .items {
        font-size: 16px;
        font-family: ‘Open Sans’;
        font-weight: 500;
        color: #909090;
        line-height: 10px;
    }

    .total-amount {
        font-size: 20px;
        font-family: ‘Open Sans’;
        font-weight: 900;
        color: #202020;
    }

    .button {
        margin-top: 5px;
        width: 100%;
        height: 40px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-size: 16px;
        font-family: ‘Open Sans’;
        font-weight: 600;
    }
</style>