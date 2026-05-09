<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        $query = Contact::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->recent()->paginate(20);
        
        $unreadCount = Contact::where('status', 'unread')->count();

        return view('admin.contacts.index', compact('contacts', 'unreadCount'));
    }

    public function show(Contact $contact): View
    {
        // Mark as read if unread
        if ($contact->is_unread) {
            $contact->markAsRead();
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function markAsRead(Contact $contact): RedirectResponse
    {
        $contact->markAsRead();

        return redirect()
            ->back()
            ->with('success', 'Message marked as read!');
    }

    public function markAsReplied(Contact $contact): RedirectResponse
    {
        $contact->markAsReplied();

        return redirect()
            ->back()
            ->with('success', 'Message marked as replied!');
    }

    public function archive(Contact $contact): RedirectResponse
    {
        $contact->archive();

        return redirect()
            ->back()
            ->with('success', 'Message archived!');
    }

    public function updateNotes(Request $request, Contact $contact): RedirectResponse
    {
        $request->validate(['admin_notes' => 'nullable|string|max:1000']);
        
        $contact->update(['admin_notes' => $request->admin_notes]);

        return redirect()
            ->back()
            ->with('success', 'Notes updated!');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Message deleted!');
    }

    public function bulkAction(Request $request): RedirectResponse
    {
        $request->validate([
            'action' => 'required|in:read,archive,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:contacts,id',
        ]);

        $contacts = Contact::whereIn('id', $request->ids);

        switch ($request->action) {
            case 'read':
                $contacts->update(['status' => 'read', 'read_at' => now()]);
                $message = 'Messages marked as read!';
                break;
            case 'archive':
                $contacts->update(['status' => 'archived']);
                $message = 'Messages archived!';
                break;
            case 'delete':
                $contacts->delete();
                $message = 'Messages deleted!';
                break;
        }

        return redirect()
            ->back()
            ->with('success', $message);
    }

    public function markAllAsRead(): RedirectResponse
    {
        Contact::where('status', 'unread')->update([
            'status' => 'read',
            'read_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'All messages marked as read!');
    }
}
