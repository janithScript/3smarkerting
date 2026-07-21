<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\CompanySetting;
use App\Models\Distributor;
use App\Models\DistributorHead;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $companySetting = CompanySetting::first();
        $distributors = Distributor::all();
        $distributorHead = DistributorHead::first();

        return view('contact.index', compact('companySetting', 'distributors', 'distributorHead'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $contactMessage = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        try {
            $companySetting = CompanySetting::first();
            if ($companySetting && $companySetting->company_email) {
                Mail::to($companySetting->company_email)->send(new ContactFormMail($contactMessage));
            }
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Contact form email failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }
}
