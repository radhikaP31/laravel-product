<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs') }}
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
                <a href="/blogs/add" class="btn btn-primary-color float-right">New Blog</a>
                <h3>Blogs</h3>
                <table class="center">
                    <thead>
                        <tr>
                            <th class="actions"><?= __('Actions') ?></th>
                            <th>Id</th>
                            <th>User</th>
                            <th>Title</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)

                        <tr>
                            <td>
                                <a href="/blogs/show/{{ $blog->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-eye"></i></span>
                                </a>
                                <a href="/blogs/edit/{{ $blog->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-pencil"></i></span>
                                </a>
                                <a href="/blogs/delete/{{ $blog->id }}" class="btn btn-xs">
                                    <span><i class="fa fa-trash"></i></span>
                                </a>
                            </td>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->user['name'] }}</td>
                            <td>{{ $blog->name }}</td>
                            @if (file_exists(public_path('storage/images/blogs/'.$blog->image)))
                            <td>
                                <a href="{{ asset('storage/images/blogs/'.$blog->image) }}" target="_blank">
                                    <img src="{{ asset('storage/images/blogs/'.$blog->image) }}" alt="{{$blog->name}}" width="160px" height="100px" />
                                </a>
                            </td>
                            @else
                            <td>
                                <img src="{{ asset('storage/images/no_image.png') }}" alt="{{$blog->name}}" width="160px" height="100px" />
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 2%;">
                    {{$blogs->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>