<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;


class ProjectController extends Controller
{
    public function index()
    {
        /* $projects = Project::all(); */
        /* $projects = Project::orderByDesc('id')->get()->paginate(6); */

        $projects = Project::with('technologies', 'type')->orderByDesc('id')->paginate(6);

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
    public function show($slug)
    {
        $project = Project::with('technologies', 'type')->where('slug', $slug)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'response' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => '404 Sorry nothing found!'
            ]);
        }
    }
    public function filtered()
    {
        //passa i projects filtrati
        if (request()->has('type_id')) {
            $projects = Project::with('technologies', 'type')
                ->where('type_id', request()->input('type_id'))
                ->orderByDesc('id')
                ->paginate(6);

            return response()->json([
                'success' => true,
                'projects' => $projects
            ]);
        } else {
            return $this->index();
        }
    }
    public function latest()
    {
        $projects = Project::with('technologies', 'type')->orderByDesc('id')->take(3)->get();

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
}
