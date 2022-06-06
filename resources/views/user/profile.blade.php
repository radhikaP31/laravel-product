<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12 content">
                <h1>{{ $user->name }}</h1>
                <table class="center">
                    <tbody>
                        <tr>
                            <td>Id</td>
                            <td><?= $user->id; ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?= $user->name; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?= $user->email; ?></td>
                        </tr>
                        <tr>
                            <td>DOB</td>
                            <td><?= $user->date_of_birth; ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>