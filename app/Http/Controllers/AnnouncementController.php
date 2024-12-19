<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Http\Requests\AnnouncementUpdateRequest;
use App\Http\Resources\AnnouncementIndexResource;
use App\Http\Resources\AnnouncementShowResource;
use App\Http\Resources\AnnouncementUpdateResource;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcement = Announcement::all();
        return AnnouncementIndexResource::collection($announcement);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnnouncementRequest $request)
    {
        $photo  = '';
        if ($request->hasFile('photo')) {
            $photo  = $request->file('photo')->store('public/images');
        }
        Announcement::create([
            'photo' => $photo,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar
        ]);
        return redirect()->route('ads.page')->with('success', 'Ads created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        return new AnnouncementShowResource($announcement);
    }

    public function show_for_update(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        return new AnnouncementUpdateResource($announcement);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ads = Announcement::findOrFail($id);

        return view('edit_ads', compact('ads'));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnnouncementUpdateRequest $request, string $id)
    {
        $announcement = Announcement::findOrFail($id);
        if ($request->all() === null || count($request->all()) === 0) {
            return $this->returnError('request is empty', 403);
        }
        $announcement->update($request->all());
        $photo = '';
        if ($request->hasFile('photo')) {
            Storage::delete($announcement->photo);
            $photo  = $request->file('photo')->store('public/images');
            $announcement->update([
                'photo' => $photo
            ]);
        }
        return redirect()->route('ads.page')->with('success', 'Ads updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $announcement = Announcement::findOrFail($id);
        Storage::delete($announcement->photo);
        $announcement->delete();
        return redirect()->route('ads.page')->with('success', 'Ads deletd successfully');
    }
}
