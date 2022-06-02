<x-header componentName="John" />
<div class="container" style="margin-top: 5%;">
    <div class="col-md-12 content">
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
                @if (file_exists(public_path('storage/images/blogs/'.$blog->image)))
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
    </div>
</div>