<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Session};
use App\Models\Contact;

class PageController extends Controller
{
    public function about() {
        return view('website.pages.about-us');
    }
    public function privacypolicy() {
        return view('website.pages.privacy-policy');
    }
    public function returnrefundpolicy() {
        return view('website.pages.return-refund-policy');
    }
    public function faqs() {
        return view('website.pages.faqs');
    }
    public function contact() {
        return view('website.pages.contact-us');
    }
    public function contact_perform(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
