<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index($category_id)
    {
        Category::findOrFail($category_id); // Ensure the category exists
        $services = Service::where('category_id', $category_id)->get();

        if ($services->isEmpty()) {
            return response()->json(['data' => []], 200);
        }


        return ServiceResource::collection($services);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($category_id)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        Service::create($request->all());
        return redirect()->route('service.page', ['category_id' => $request->category_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::findOrFail($id);
        return new ServiceResource($service);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);

        return view('edit_service', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceUpdateRequest $request, string $id)
    {
        if ($request->all() === null || count($request->all()) === 0) {
            return response([
                'message' => 'request is empty'
            ], 403);
        }
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return redirect()->route('service.page', ['category_id' => $service->category_id])->with('success', 'Slide Show updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return $this->returnSuccessMessage("destroy successfully");
    }
}
