<x-header componentName="John" />
<div class="container" >
    <div class="col-md-12 content">
        <h3>Create User</h3>
        <table class="center">
            <tbody>
                <form method="post" action="/login/authenticate" enctype="multipart/form-data">
                    @csrf
                    <table>
                        <tbody>
                            <tr>
                                <td><label>Username:</label></td>
                                <td><input type="text" name="username" value="{{ old('username') }}" />
                                    @error('username')
                                    <div class="text-red">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td><label>Password:</label></td>
                                <td><input type="text" name="password" value="" />
                                    @error('password')
                                    <div class="text-red">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary-color">Submit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </tbody>
        </table>
    </div>
</div>