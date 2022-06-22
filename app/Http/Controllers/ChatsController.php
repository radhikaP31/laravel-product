<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view('chat.view', [
            'users' => $users
        ]);
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages($id)
    {
        $user = Auth::user();

        $messages = Message::with('user','receiver')
                    ->whereIn('user_id', [$user->id, $id])
                    ->whereIn('receiver_user_id', [$user->id, $id])
                    ->orderBy('created_at')
                    ->get();

        $receiver = User::where('id',$id)->first();

        return view('chat.chat', [
            'user' => $user,
            'messages' => $messages,
            'receiver' => $receiver,
        ]);
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();


        // dd('asf');
        $message = $user->messages()->create([
            'message' => $request->input('message'),
            'user_id' => $request->input('user_id'),
            'receiver_user_id' => $request->input('receiver_user_id')
        ]);
        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
