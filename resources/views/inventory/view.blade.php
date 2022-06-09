<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12 content">
                <h1>
                    {{ $inventory->product['p_name'] }}
                </h1>
                <a href="/inventory" class="btn btn-primary-color float-right">Back</a>
                <table class="center">
                    <tbody>
                        <tr>
                            <td>Id</td>
                            <td><?= $inventory->id; ?></td>
                        </tr>
                        <tr>
                            <td>Product Name:</td>
                            <td><?= $inventory->product['p_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td><?= $inventory->quantity; ?></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><?= $inventory->price; ?></td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td><?= $inventory->tax; ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>