<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* dd(Project::all()); */
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        /* dd($request->all()); */

        /* validate */
        $validated = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        if($request->has('cover_image')) {
            $image_path = Storage::put('uploads', $validated['cover_image']);
            $validated['cover_image'] = $image_path;
        }

        /* create */
        /* Project::create($validated); */

        /* $technologies = Technology::all(); */
        
        $project = Project::create($validated);

        if($request->has('technologies')) {
            $project->technologies()->attach($validated['technologies']);
        }
        
        /* redirect */
        return to_route('admin.projects.index')->with('message', "Project $request->title created correctly");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        /* $technology = Technology::all();
        return view('admin.projects.show', compact('project', 'technology')); */

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        /* validate */
        $validated = $request->validated();
        $slug = Str::slug($request->title, '-');
        $validated['slug'] = $slug;

        /* usa public storage */
        if($request->has('cover_image')) {
            if($project->cover_image){
                Storage::delete($project->cover_image);
            }
            $image_path = Storage::put('uploads', $validated['cover_image']);
            $validated['cover_image'] = $image_path;
        }

        /* update */
        $project->update($validated);

        /* redirect */
        /* return to_route('admin.projects.index'); */
        /* return redirect()->back(); */
        return to_route('admin.projects.index')->with('message', "Project $project->title updated correctly");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {   
        if($project->cover_image){
            Storage::delete($project->cover_image);
        }

        $project->delete();

        return to_route('admin.projects.index')->with('message', "Project $project->title deleted correctly");
    }
}
