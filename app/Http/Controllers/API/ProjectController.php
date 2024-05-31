<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){
        /* $projects = Project::with('technologies', 'type')->paginate(6); */
        $projects = Project::all();
        
        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }
}
