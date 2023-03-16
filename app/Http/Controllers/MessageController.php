<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function conversation($userId)
    {
        $data['users'] = User::where('id', '!=', Auth::id())->get();
        $data['friendInfo'] = User::findOrFail($userId);
        $data['myInfo'] = User::find(Auth::id());
        $data['userId'] = $userId;

        // dd($data['friendInfo']);

        return view('message.conversation', $data);
    }
}
