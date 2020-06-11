<?php

namespace App\Http\Controllers;

use App\publicMessenger;
use Illuminate\Http\Request;
use Pusher\Pusher;
use wDevStudio\LaravelMessenger\Facades\Messenger;
use wDevStudio\LaravelMessenger\Models\Conversation;
use wDevStudio\LaravelMessenger\Models\Message;

class MessageController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['web', 'auth']);
    }

    /**
     * Get messenger page.
     *
     * @param  int  $withId
     * @return Response
     */

    public function defaultLaravelMessenger() {
        $withId = Conversation::where('user_one', \Auth::id())->orWhere('user_two', \Auth::id())->first();
        if ($withId) {
            if (\Auth::id() == (int) $withId->user_one) {
                return redirect()->route('messenger', ['id' => $withId->user_two]);
            } else {
                return redirect()->route('messenger', ['id' => $withId->user_one]);
            }

        } else {
            // dd('you donot have any active chats');
            $threads = [];
            $messages = [];
            $convo = 'set';
            return view('freelancer.messages', compact('messages', 'threads', 'convo'));
        }
    }

    public function laravelMessenger($withId) {
        Messenger::makeSeen(auth()->id(), $withId);
        $withUser = config('messenger.user.model', 'App\User')::findOrFail($withId);
        $messages = Messenger::messagesWith(auth()->id(), $withUser->id);
        $threads = Messenger::threads(auth()->id());
        // dd(collect($threads));
        // return view('messenger::messenger', compact('withUser', 'messages', 'threads'));
        return view('freelancer.messages', compact('withUser', 'messages', 'threads'));
    }

    /**
     * Create a new message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, Message::rules());
        // dd('here');
        $authId = auth()->id();
        $withId = $request->withId;
        if ($request->withId == 0) {
            $conversation = Messenger::getConversation(0, 0);
        } else {

            $conversation = Messenger::getConversation($authId, $withId);
        }

        if (!$conversation) {
            $conversation = Messenger::newConversation($authId, $withId);
        }

        if ($conversation->id == 1) {

            $message = Messenger::newMessage($conversation->id, \Auth::id(), $request->message);

        } else {

            $message = Messenger::newMessage($conversation->id, $authId, $request->message);
        }

        // Pusher
        $pusher = new Pusher(
            config('messenger.pusher.app_key'),
            config('messenger.pusher.app_secret'),
            config('messenger.pusher.app_id'),
            [
                'cluster' => config('messenger.pusher.options.cluster'),
            ]
        );

        if ($conversation->id == 1) {
            $pusher->trigger('publicmessenger-channel', 'pubmessenger-event', [
                'message' => $message,
                'senderId' => $authId,
                'withId' => $withId,
            ]);
        } else {
            $pusher->trigger('messenger-channel', 'messenger-event', [
                'message' => $message,
                'senderId' => $authId,
                'withId' => $withId,
            ]);
        }

        if ($request->ajax()) {

            return response()->json([
                'success' => true,
                'message' => $message,
            ], 200);

        }

        return back()->with('success', 'Message sent successfully');

    }

    public function storePublicMessage(Request $request) {
        $this->validate($request, Message::rules());

        $authId = auth()->id();
        $message = publicMessenger::create([
            'sender_id' => $request->sender_id,
            'message' => $request->message,
        ]);

        // Pusher
        $pusher = new Pusher(
            config('messenger.pusher.app_key'),
            config('messenger.pusher.app_secret'),
            config('messenger.pusher.app_id'),
            [
                'cluster' => config('messenger.pusher.options.cluster'),
            ]
        );

        $pusher->trigger('publicmessenger-channel', 'pubmessenger-event', [
            'message' => $message,
            'senderId' => $authId,
        ]);

        // $pusher = new Pusher(
        //     config('messenger.pusher.app_key'),
        //     config('messenger.pusher.app_secret'),
        //     config('messenger.pusher.app_id'),
        //     [
        //         'cluster' => config('messenger.pusher.options.cluster'),
        //     ]
        // );

        // $pusher->trigger('mys-channel', 'mys-event', [
        //     'message' => $message,
        //     'senderId' => $authId,
        // ]);

        if ($request->ajax()) {

            return response()->json([
                'success' => true,
                'message' => $message,
            ], 200);

        }
    }

    /**
     * Load threads view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response.
     */
    public function loadThreads(Request $request) {
        if ($request->ajax()) {
            $withUser = config('messenger.user.model', 'App\User')::findOrFail($request->withId);
            $threads = Messenger::threads(auth()->id());
            $view = view('messenger::partials.threads', compact('threads', 'withUser'))->render();

            return response()->json($view, 200);
        }
    }

    /**
     * Load more messages.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response.
     */
    public function moreMessages(Request $request) {
        $this->validate($request, ['withId' => 'required|integer']);

        if ($request->ajax()) {
            $messages = Messenger::messagesWith(
                auth()->id(),
                $request->withId,
                $request->take
            );
            $view = view('messenger::partials.messages', compact('messages'))->render();

            return response()->json([
                'view' => $view,
                'messagesCount' => $messages->count(),
            ], 200);
        }
    }

    /**
     * Make a message seen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function makeSeen(Request $request) {
        Messenger::makeSeen($request->authId, $request->withId);

        return response()->json(['success' => true], 200);
    }

    /**
     * Delete a message.
     *
     * @param  int  $id
     * @return Response.
     */
    public function destroy($id) {
        $confirm = Messenger::deleteMessage($id, auth()->id());

        return response()->json(['success' => true], 200);
    }

    public function showgroupchat() {
        $messages = Messenger::gmessagesWith(0, 0);
        $withId = 0;
        // dd($messages);
        return view('employer.messages', compact('messages', 'withId'));
    }
}
