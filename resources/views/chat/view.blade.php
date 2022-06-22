<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container" style="margin:auto;">
            <div class="col-md-12 content">
                <div class="panel panel-default">
                    <div class="panel-heading">Chats</div>
                    @if($users->count() > 0)
                    <div class="panel-body">
                        <ul class="chat">
                            @foreach($users as $key => $user)
                            <li class="left clearfix">
                                <div class="chat-body clearfix" style="border: 1px solid var(--primary_color);margin: 4px;border-radius: 20px;">
                                    <div class="header" style="padding:5px">
                                        <a href="/messages/{{$user->id}}" class="list-group-item list-group-item-action border-0">
                                            <div class="d-flex align-items-start">
                                                @if ($user->profile_picture && file_exists(public_path('storage/images/users/'.$user->profile_picture)))
                                                @php $profile_picture = asset('storage/images/users/'.$user->profile_picture) @endphp
                                                @else
                                                @php $profile_picture = asset('storage/images/user_no_image.jpg') @endphp
                                                @endif

                                                <img src="{{ $profile_picture }}" target="_blank" class="rounded-circle mr-1" alt="{{$user->name}}" width="40" height="40">
                                                <div class="flex-grow-1 ml-3 col-md-11">
                                                    {{$user->name}}
                                                    <div class="small"><span class="fa fa-circle chat-online" style="color:green"></span> Online</div>
                                                </div>
                                                <i class="fa fa-2x fa-telegram" style="color:var(--primary_color)" aria-hidden="true"></i>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>