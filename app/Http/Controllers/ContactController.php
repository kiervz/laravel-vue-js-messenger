<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Resources\ContactResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index() 
    {
        $contacts = User::where('id', '<>', Auth::id())->get();

        $unreadIDs = Message::select(DB::raw('`from` as sender_id, count(`from`) as messages_count'))
                        ->where('to', Auth::id())
                        ->where('read', false)
                        ->groupBy('from')
                        ->get();

        $contacts = $contacts->map(function($contact) use ($unreadIDs) {
            $contactUnread = $unreadIDs->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return response()->json(['contacts' => $contacts]);
    }

    public function getMessageFor($id) {
        $messages = Message::where(function ($q) use ($id) {
            $q->Where('from', $id);
            $q->Where('to', Auth::id());
        })->orWhere(function ($q) use ($id) {
            $q->Where('from', Auth::id());
            $q->Where('to', $id);
        })->get();

        return response()->json(['messages' => $messages]);
    }

    public function send(Request $request) {
        $message = Message::create([
            'from' => Auth::id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);
        
        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'message' => $message
        ]);
    }
}
