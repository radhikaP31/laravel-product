<x-header componentName="John" />
<div class="container" style="margin-top: 5%;">
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
                    <!-- <th>Profile Picture</th> -->
                    <th>Username</th>
                    <th>Created</th>
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
                        <td>{{ $user->gender }}</td>
                        <!-- <td>{{ $user->profile_picture }}</td> -->
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->created_at }}</td>
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

<style>
    .w-5{
        display:none;
    }

    nav div{
        text-align: center;
    }

    nav p{
        padding-top: 10px;
    }
</style>



