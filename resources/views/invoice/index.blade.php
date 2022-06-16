<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
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
                <h3>Orders</h3>
                @if(isset($orders))
                <table class="center">
                    <thead>
                        <tr>
                            <th class="actions"><?= __('Actions') ?></th>
                            <th>Id</th>
                            <th>User</th>
                            <th>Order No</th>
                            <th>Invoice No</th>
                            <!-- <th>Total Order Items</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)

                        <tr>
                            <td>
                                <a href="/invoice/view/{{ $order->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-eye"></i></span>
                                </a>
                                @if($order->status == 'paid')
                                <a href="/invoice/changeStatus/unpaid/{{ $order->id }}" class="btn btn-xs" title="Unpaid">
                                    <span><i class="fa fa-ban"></i></span>
                                </a>
                                @else
                                <a href="/invoice/changeStatus/paid/{{ $order->id }}" class="btn btn-xs" title="Paid">
                                    <span><i class="fa fa-check"></i></span>
                                </a>
                                @endif
                            </td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->users['name'] }}</td>
                            <td>#{{ $order->orders['order_no'] }}</td>
                            <td>#{{ $order->invoice_no }}</td>
                            <!-- <td>{{ $order->id }}</td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 2%;">
                    {{$orders->links()}}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>