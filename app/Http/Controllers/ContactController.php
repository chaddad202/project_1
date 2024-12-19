<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\ContactIndexResource;
use App\Http\Resources\ContactUpdateResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\GeneralTrait;

class ContactController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::all();
        return ContactIndexResource::collection($contact);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        $icon  = '';
        if ($request->hasFile('icon')) {
            $icon  = $request->file('icon')->store('public/images');
        }
        Contact::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'link'=>$request->link,
            'icon' => $icon
        ]);
        return redirect()->route('contact.page')->with('success', 'Contact created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return new ContactIndexResource($contact);
    }
    public function show_for_update(string $id)
    {
        $contact = Contact::findOrFail($id);
        return new ContactUpdateResource($contact);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);

        return view('edit_contact', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactUpdateRequest $request, string $id)
    {
        if ($request->all() === null || count($request->all()) === 0) {
            return response([
                'message' => 'request is empty'
            ], 403);
        }
        $contact = Contact::findOrFail($id);
        $icon = '';
        $contact->update($request->all());
        if ($request->hasFile('icon')) {
            Storage::delete($contact->icon);
            $icon  = $request->file('icon')->store('public/images');
            $contact->update([
                'icon' => $icon
            ]);
        }
        return redirect()->route('contact.page')->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        Storage::delete($contact->icon);
        $contact->delete();
        return redirect()->route('contact.page')->with('success', 'Contact deleted successfully');
    }
}
