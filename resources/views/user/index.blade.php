<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container" style="margin: auto;">
            <div class="col-md-12 content">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <a href="/users/add" class="btn btn-primary-color float-right">New User</a>
                <h3>Users</h3>
                <table class="center">
                    <thead>
                        <tr>
                            <th class="actions"><?= __('Actions') ?></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Profile Picture</th>
                            <th>Username</th>
                            <!-- <th>Created</th> -->
                            <!-- <th>Rating</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <a href="/users/view/{{ $user->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-eye"></i></span>
                                </a>
                                <a href="/users/edit/{{ $user->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-pencil"></i></span>
                                </a>
                                <a href="/users/delete/{{ $user->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-trash"></i></span>
                                </a>
                            </td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->date_of_birth }}</td>
                            <td>{{ $user->gender == 'm' ? 'Male' : 'Female'; }}</td>
                            @if (file_exists(public_path('storage/images/users/'.$user->profile_picture)))
                            <td>
                                <a href="{{ asset('storage/images/users/'.$user->profile_picture) }}" target="_blank">
                                    <img src="{{ asset('storage/images/users/'.$user->profile_picture) }}" alt="{{$user->name}}" width="160px" height="100px" />
                                </a>
                            </td>
                            @else
                            <td>
                                <img src="{{ asset('storage/images/no_image.png') }}" alt="{{$user->name}}" width="160px" height="100px" />
                            </td>
                            @endif

                            <td>{{ $user->username }}</td>
                            <!-- <td>{{ $user->created_at }}</td> -->
                            <!-- <td>{{ $user->rating }}</td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 2%;">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>