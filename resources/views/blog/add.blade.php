<x-header componentName="John" />
<div class="container" style="margin-top: 5%;">
    <div class="col-md-12 content">
        <h3>Create Blog</h3>
        <table class="center">
            <tbody>
                <form method="post" action="/blogs/add" enctype="multipart/form-data">
                    @csrf
                    <table>
                        <tbody>
                            <tr>
                                <td><label>User:</label></td>
                                <td>
                                    <select name="user_id">
                                        <option value="">Select an Option</option>
                                        @foreach($users as $user)

                                        <option value="{{ $user->id }}" {{ (old("user_id") == $user->id ? "selected":"") }}>{{ $user->name }}</option>

                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Title:</label></td>
                                <td><input type="text" name="name" value="{{ old('name') }}" />
                                    @error('name')
                                    <div class="text-red">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="description">Description</label>
                                </td>
                                <td>
                                    <textarea name="description" rows="5">{{ old('description') }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Image:</label></td>
                                <td><input type="file" name="image" value="" />
                                    @error('image')
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