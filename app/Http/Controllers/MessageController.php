<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\PrivateMessageEvent;
use App\Models\UserMessage;

class MessageController extends Controller
{
    public function conversation($userId)
    {
        $data['users'] = User::where('id', '!=', Auth::id())->get();
        $data['friendInfo'] = User::findOrFail($userId);
        $data['myInfo'] = User::find(Auth::id());
        $data['userId'] = $userId;

        // 7
        // $from = Auth::id();
        // $to = $data['userId'];

        // $messages = UserMessage::where('sender_id', $from)->where('receiver_id', $to)->orderBy('created_at', 'asc')->get();

        // dd($messages[0]);





        return view('message.conversation', $data);
    }

    public function smsFetch($userId)
    {
        $from = Auth::id();

        $messages = UserMessage::with('message')->where('sender_id', $from)->where('receiver_id', $userId)->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' =>'required',
            'receiver_id' => 'required'
        ]);

        $senderId = Auth::id();
        $receiverId = $request->receiver_id;

        $message = Message::create([
            'message' => $request->message
        ]);

        if ($message) {
            try {
                $message->users()->attach($senderId, ['receiver_id' => $receiverId]);

                $sender = User::where('id', $senderId)->first();

                $data = [];

                $data['sender_id'] = $senderId;
                $data['sender_name'] = $sender->name;
                $data['receiver_id'] = $receiverId;
                $data['content'] = $message->message;
                $data['created_at'] = $message->created_at;
                $data['message_id'] = $message->id;

                event(new PrivateMessageEvent($data));

                return response()->json([
                    'data' => $data,
                    'success' => true,
                    'message' => 'Message success successfully'
                ]);

            } catch (\Throwable $th) {
                $message->delete();
            }
        }
    }
}
