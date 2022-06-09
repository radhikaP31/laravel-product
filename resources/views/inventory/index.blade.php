<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory') }}
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
                <a href="/inventory/add" class="btn btn-primary-color float-right">New Inventory</a>
                <h3>Inventory</h3>
                @if(isset($inventories))
                <table class="center">
                    <thead>
                        <tr>
                            <th class="actions"><?= __('Actions') ?></th>
                            <th>Id</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Tax</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventories as $inventory)

                        <tr>
                            <td>
                                <a href="/inventory/view/{{ $inventory->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-eye"></i></span>
                                </a>
                                <a href="/inventory/edit/{{ $inventory->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-pencil"></i></span>
                                </a>
                                <a href="/inventory/delete/{{ $inventory->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-trash"></i></span>
                                </a>
                            </td>
                            <td>{{ $inventory->id }}</td>
                            <td>{{ $inventory->product['p_name'] }}</td>
                            <td>{{ $inventory->quantity }}</td>
                            <td>{{ $inventory->price }}</td>
                            <td>{{ $inventory->tax }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 2%;">
                    {{$inventories->links()}}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>