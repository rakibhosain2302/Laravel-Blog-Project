<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $roleName = optional($user->role)->name ?? 'Guest';

        // Only Admin and Editor can access Inbox
        if (!in_array($roleName, ['Admin', 'Editor'])) {
            return response()->view('admin.pages.error.404', [], 404);
        }


        $unreadCount = Contract::where('is_seen', false)->count();
        $messages = Contract::where('is_seen', false)->latest()->get();
        $seenMessages = Contract::where('is_seen', true)->latest()->get();
        $seenCount = $seenMessages->count();

        return view('admin.pages.inbox.inbox', compact(
            'messages',
            'seenMessages',
            'unreadCount',
            'seenCount'
        ));
    }


    public function store(Request $request)
    {
        $message = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Contract::create($message);

        return back()->with('success', 'Message sent successfully!');
    }

    public function show(string $id)
    {
        $user = auth()->user();
        $roleName = optional($user->role)->name ?? 'Guest';

        // Only Admin and Editor can access Inbox
        if (!in_array($roleName, ['Admin', 'Editor'])) {
            return response()->view('admin.pages.error.404', [], 404);
        }

        $viweMsg = Contract::findOrFail($id);
        return view('admin.pages.inbox.show', compact('viweMsg'));
    }

    public function edit(string $id)
    {
        $user = auth()->user();
        $roleName = optional($user->role)->name ?? 'Guest';

        // Only Admin and Editor can access Inbox
        if (!in_array($roleName, ['Admin', 'Editor'])) {
            return response()->view('admin.pages.error.404', [], 404);
        }

        $replyMsg = Contract::findOrFail($id);
        return view('admin.pages.inbox.reply', compact('replyMsg'));
    }


    public function seenMsg(string $id)
    {
        $user = auth()->user();
        $roleName = optional($user->role)->name ?? 'Guest';

        // Only Admin and Editor can access Inbox
        if (!in_array($roleName, ['Admin', 'Editor'])) {
            return response()->view('admin.pages.error.404', [], 404);
        }

        $viweMsg = Contract::findOrFail($id);

        if (!$viweMsg->is_seen) {
            $viweMsg->update(['is_seen' => true]);
        }

        return redirect()->back()->with('mtoseen', 'Message moved to seen message box.');
    }

    public function update(Request $request, string $id) {}

    public function destroy(string $id)
    {
        Contract::destroy($id);
        return redirect()->back()->with('success', 'Message Deleted Successfully!');
    }

    public function undo($id)
    {
        $message = Contract::findOrFail($id);
        $message->is_seen = false; // Unseen করে দিন
        $message->save();

        return redirect()->back()->with('success', 'Message moved back to Inbox.');
    }
}
