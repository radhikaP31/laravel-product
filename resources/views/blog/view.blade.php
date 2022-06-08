<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="col-md-12 content">
                @can('view', $blog)
                <h1>{{ $blog->name }}</h1>
                <table class="center">
                    <tbody>
                        <tr>
                            <td>Id</td>
                            <td><?= $blog->id; ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><?= $blog->user['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td><?= $blog->name; ?></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><?= $blog->description; ?></td>
                        </tr>
                        @if ($blog->image && file_exists(public_path('storage/images/blogs/'.$blog->image)))
                        <tr>
                            <td><label>Image:</label></td>
                            <td>
                                <a href="{{ asset('storage/images/blogs/'.$blog->image) }}" target="_blank">
                                    <img src="{{ asset('storage/images/blogs/'.$blog->image) }}" alt="{{$blog->name}}" width="160px" height="100px" />
                                </a>
                            </td>
                        </tr>
                        @endif

                    </tbody>
                </table>
                @elsecan('create', App\Models\Blogs::class)
                <p>Please Create new Blog..</p>
                @else
                <p> Not Permitted..</p>
                @endcan

            </div>
        </div>
    </div>
</x-app-layout>