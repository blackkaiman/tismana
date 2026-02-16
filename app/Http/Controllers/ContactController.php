<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;
use App\Models\Setting;

class ContactController extends Controller
{
    public function index()
    {
        $settings = Setting::getGroup('contact');
        return view('public.contact', compact('settings'));
    }

    public function store(ContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());

        return redirect()->route('contact')
            ->with('success', 'Mesajul a fost trimis cu succes! Vă vom răspunde în cel mai scurt timp.');
    }
}
