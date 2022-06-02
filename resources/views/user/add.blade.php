<x-header componentName="John" />
<div class="container" style="margin-top: 5%;">
    <div class="col-md-12 content">
        <h3>Create User</h3>
        <table class="center">
            <tbody>
                <form method="post" action="/users/add" enctype="multipart/form-data">
                    @csrf
                    <table>
                        <tbody>
                            <tr>
                                <td><label>Role:</label></td>
                                <td>
                                <select name="role_id">
                                    <option value="">Select an Option</option>
                                    @foreach($roles as $role)

                                        <option value="{{ $role->id }}" {{ (old("role_id") == $role->id ? "selected":"") }}>{{ $role->name }}</option>

                                    @endforeach
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Name:</label></td>
                                <td><input type="text" name="name" value="{{ old('name') }}" />
                                    @error('name')
                                        <div class="text-red">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td><label>Email:</label></td>
                                <td><input type="text" name="email" value="{{ old('email') }}" />
                                    @error('email')
                                        <div class="text-red">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
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
                                <td><label>Date of Birth:</label></td>
                                <td><input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" />
                                    @error('date_of_birth')
                                        <div class="text-red">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td><label>Profile Picture:</label></td>
                                <td><input type="file" name="profile_picture" value="" />
                                    @error('profile_picture')
                                        <div class="text-red">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td><label for="gender">Gender:</label></td>
                                <td>
                                    <input type="hidden" name="gender" value="">
                                    <label class="radio" for="gender-f">
                                        <input type="radio" name="gender" value="f" id="gender-f" {{ old('gender') == 'f' ? 'checked' : ''}} >Female
                                    </label>
                                    <label class="radio" for="gender-m">
                                        <input type="radio" name="gender" value="m" id="gender-m" {{ old('gender') == 'm' ? 'checked' : ''}}>Male
                                    </label>               
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="about">Tell us something about you</label>
                                </td>
                                <td>
                                    <textarea name="about" rows="5" >{{ old('about') }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="rating">Rate Us</label>
                                </td>
                                <td>
                                    <select name="rating">
                                        <option value="">Select an Option</option>
                                        <option value="1" {{ (old("rating") == 1 ? "selected":"") }}>1</option>
                                        <option value="2" {{ (old("rating") == 2 ? "selected":"") }} >2</option>
                                        <option value="3" {{ (old("rating") == 3 ? "selected":"") }} >3</option>
                                        <option value="4" {{ (old("rating") == 4 ? "selected":"") }} >4</option>
                                        <option value="5" {{ (old("rating") == 5 ? "selected":"") }} >5</option>
                                    </select>
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




