<x-header componentName="John" />
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" :message="$errors->first('name')" :is_error="$errors->has('name')" autofocus />

            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" :message="$errors->first('email')" :is_error="$errors->has('email')" autofocus />
            </div>

            <!-- Date of Birth -->
            <div class="mt-4">
                <x-label for="date_of_birth" :value="__('Date of Birth')" />

                <x-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" :message="$errors->first('date_of_birth')" :is_error="$errors->has('date_of_birth')" autofocus />
            </div>

            <!-- Profile Picture -->
            <div class="mt-4">
                <x-label for="profile_picture" :value="__('Profile Picture')" />

                <x-input id="profile_picture" class="block mt-1 w-full" type="file" name="profile_picture" :value="old('profile_picture')" :message="$errors->first('profile_picture')" :is_error="$errors->has('profile_picture')" autofocus />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-label for="gender" :value="__('Gender')" />
                <input type="hidden" name="gender" value="">
                <div>
                    <label class="radio" for="gender-f" style="display: inline;float: left;">
                        <input type="radio" name="gender" value="f" id="gender-f" {{ old('gender') == 'f' ? 'checked' : ''}} class=" block mt-1" style="display: inline;float: left;margin-right: 5px;">Female
                    </label>
                    <label class="radio" for="gender-m" style="margin-left: 5px;">
                        <input type="radio" name="gender" value="m" id="gender-m" {{ old('gender') == 'm' ? 'checked' : ''}} class="block mt-1" style="display: inline;float: left;margin-left: 10px;">Male
                    </label>

                </div>
            </div>

            <!-- Username -->
            <div class="mt-4">
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" :message="$errors->first('username')" :is_error="$errors->has('username')" autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" :message="$errors->first('password')" :is_error="$errors->has('password')" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>