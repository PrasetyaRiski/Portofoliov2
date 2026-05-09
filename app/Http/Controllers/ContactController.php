<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('public.contact');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        $contact = Contact::create([
            ...$request->validated(),
            'ip_address' => $request->ip(),
        ]);

        // Send email notification (optional)
        try {
            // Mail::to(config('portfolio.owner.email'))->send(new ContactFormMail($contact));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            Log::error('Failed to send contact notification: ' . $e->getMessage());
        }

        return redirect()
            ->back()
            ->with('success', 'Thank you for your message! I will get back to you soon.');
    }
}
