<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('id','desc');
        if(request()->has('q') && !empty(request()->q)) {
            $contacts->where('name', 'LIKE',  '%' . request()->q . '%');
        }
        if(request()->has('phone') && !empty(request()->phone)) {
            $contacts->where('phone', request()->phone);
        }
        if(request()->has('subject') && !empty(request()->subject)) {
            $contacts->where('subject', request()->subject);
        }
        if(request()->has('message') && !empty(request()->message)) {
            $contacts->where('message', request()->message);
        }
        $contacts = $contacts->paginate(10);
        return view('dashboards.admin.components.contacts.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contact = Contact::orderBy('id', 'desc')->get();
        return view('dashboards.admin.components.contacts.create', compact('contact'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        $validator['success'] = 'Contact created successfully';
        return back()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('dashboards.admin.components.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
    
        $contact = Contact::findOrFail($id);
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
    
        $validator['success'] = 'Contact Updated successfully';
        return back()->withErrors($validator);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        $validator['success'] = 'Contact deleted successfully';
        return back()->withErrors($validator);
    }
}
