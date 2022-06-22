<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container" style="margin:auto;">
            <div class="col-md-12 content">
                <div class="panel panel-default">
                    <h1 class="panel-heading" style="font-weight:600">{{ $receiver->name}}</h1>

                    @if($messages->count() > 0)
                    <div class="panel-body">
                        <ul class="chat">
                            @foreach($messages as $key => $message)
                            <li class="left clearfix">
                                <div class="chat-body clearfix" style="border: 1px solid var(--primary_color);margin: 4px;">
                                    <div class="header" style="padding:5px">
                                        <strong class="primary-font">
                                            {{$message->user['name']}}
                                        </strong>
                                    </div>
                                    <p style="padding:5px">
                                        {{$message->message}}
                                        <br><small>{{ date('Y-m-d', strtotime($message->created_at)) }}</small>
                                    </p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="panel-footer">
                        <div class="input-group">
                            <input id="btn-input" type="text" name="message" class="form-control input-sm message" placeholder="Type your message here...">
                            <input id="btn-input" type="hidden" name="user_id" class="form-control input-sm user_id" value="{{$user->id}}">
                            <input id="btn-input" type="hidden" name="receiver_user_id" class="form-control input-sm receiver_user_id" value="{{$receiver->id}}">

                            <span class="input-group-btn">
                                <button class="btn btn-primary sendMessage" id="btn-chat sendMessage" data-name="{{$user->name}}">
                                    Send
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>