<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlideRequest;
use App\Http\Resources\SlideResource;
use App\Models\SlideShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\GeneralTrait;

class SlideShowController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $slide = SlideShow::all();
        return SlideResource::collection($slide);
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
    public function store(SlideRequest $request)
    {
        $photo  = '';
        if ($request->hasFile('photo')) {
            $photo  = $request->file('photo')->store('public/images');
        }

        SlideShow::create([
            'photo' => $photo,
        ]);
        return redirect()->route('slideShow.page')->with('success', 'Slide Show created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $slide = SlideShow::findOrFail($id);
        return new SlideResource($slide);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slideShow = SlideShow::findOrFail($id);

        return view('edit_slideShow', compact('slideShow'));  //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SlideRequest $request, string $id)
    {
        $slide = SlideShow::findOrFail($id);
        $photo = '';
        if ($request->hasFile('photo')) {
            Storage::delete($slide->photo);
            $photo  = $request->file('photo')->store('public/images');
            $slide->update([
                'photo' => $photo
            ]);
        }
        return redirect()->route('slideShow.page')->with('success', 'Slide Show updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slide = SlideShow::findOrFail($id);
        Storage::delete($slide->photo);
        $slide->delete();
        return redirect()->route('slideShow.page')->with('success', 'Slide Show deleted successfully');
    }
}
