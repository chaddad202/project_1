<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryIndexResource;
use App\Http\Resources\CategoryShowResource;
use App\Http\Resources\CategoryUpdateResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\GeneralTrait;

class CategoryController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return CategoryIndexResource::collection($category);
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
    public function store(CategoryRequest $request)
    {
        $photo  = '';
        if ($request->hasFile('photo')) {
            $photo  = $request->file('photo')->store('public/images');
        }

        Category::create([
            'photo' => $photo,
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
        ]);
        return $this->returnSuccessMessage("created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return new CategoryShowResource($category);
    }
    public function show_for_update(string $id)
    {
        $category = Category::findOrFail($id);
        return new CategoryUpdateResource($category);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        if ($request->all() === null || count($request->all()) === 0) {
            return response([
                'message' => 'request is empty'
            ], 403);
        }
        $category->update($request->all());
        $photo = '';
        if ($request->hasFile('photo')) {
            Storage::delete($category->photo);
            $photo  = $request->file('photo')->store('public/images');
            $category->update([
                'photo' => $photo
            ]);
        }
        return $this->returnSuccessMessage(' updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        Storage::delete($category->photo);
        $category->delete();
        return $this->returnSuccessMessage(' deleted Successfully ');
    }
}
