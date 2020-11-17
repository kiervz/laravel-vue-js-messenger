<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() 
    {
        $contacts = User::where('id', '<>', Auth::id())->get();

        return response()->json(['contacts' => $contacts]);
    }

    public function getMessageFor($id) {
        $messages = Message::where('from', $id)->Where('to', Auth::id())->orWhere('from', Auth::id())->where('to', $id)->get();

        return response()->json(['messages' => $messages]);
    }

    public function send(Request $request) {
        $message = Message::create([
            'from' => Auth::id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);

        return response()->json([
            'message' => $message
        ]);
    }
}
