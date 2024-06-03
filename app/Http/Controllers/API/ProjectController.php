<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;


class ProjectController extends Controller
{
    public function index()
    {
        /* $projects = Project::all(); */

        $projects = Project::with('technologies', 'type')->orderByDesc('id')->paginate(6);
        /* $projects = Project::orderByDesc('id')->get()->paginate(6); */

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
}
