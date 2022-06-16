<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12 content">
                <h1>#{{ $invoice->orders['order_no']}}</h1>
                <a href="/invoice/index" class="btn btn-primary-color float-right">Back</a>
                <table class="center">
                    <tbody>
                        <tr>
                            <td>Order No</td>
                            <td>#{{ $invoice->orders['order_no']}}</td>
                        </tr>
                        <tr>
                            <td>Invoice No</td>
                            <td>#{{$invoice->invoice_no}}</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>{{$invoice->users['name']}}</td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td>{{$invoice->amount}}</td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td>{{$invoice->tax}}</td>
                        </tr>
                        <tr>
                            <td>Total Order Amount</td>
                            <td>{{$invoice->total_amount}}</td>
                        </tr>
                    </tbody>
                </table>
                <div style="margin:2%;">
                    <h1 style="font-weight: 600;">Order Items Details:</h1>
                </div>
                <table>
                    <tr>
                        <td>Image</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total Amount</td>
                    </tr>
                    @foreach($order_item as $key => $item)

                    <?php $grand_total = $item->inventory['total_price'] * $item->quantity ?>

                    <tr>
                        <td>
                            <a href="{{ asset('storage/images/products/'.$item->product['p_image']) }}" target="_blank" class="product_image">
                                <img src="{{ asset('storage/images/products/'.$item->product['p_image']) }}" alt="{{$item->product['p_name']}}" width="120px" height="100px" style="margin:auto" />
                            </a>
                        </td>
                        <td>
                            <a href="/products/view/{{$item->product['id']}}" target="_blank">
                                <h1 class="title">{{ $item->product['p_name']}}</h1>
                            </a>

                            <p>{{ Str::limit($item->product['p_description'], 30) }}</p>
                        </td>
                        <td>
                            {{ number_format($item->inventory['price'], 2, '.', ','); }} <br><small> + Tax: {{ number_format($item->inventory['tax'], 2, '.', ','); }}</small>
                        </td>
                        <td>
                            {{$item->quantity}}
                        </td>
                        <td>
                            {{ number_format($grand_total, 2, '.', ','); }}
                        </td>
                    </tr>
                    @endforeach
                    <hr>
                    <div></div>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>