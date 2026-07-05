<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::orderByDesc('created_at')->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function toggleRead(Contact $contact): RedirectResponse
    {
        $contact->update(['is_read' => !$contact->is_read]);
        return back()->with('success', 'Contact status updated.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Contact message deleted.');
    }
}
