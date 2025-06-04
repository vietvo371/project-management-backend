<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    protected $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $projects = $this->service->getUserProjects(Auth::id());
        return response()->json($projects);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = $this->service->createProject(Auth::id(), $validated);
        return response()->json($project, 201);
    }

    public function show($id)
    {
        $project = $this->service->getUserProjects(Auth::id())->find($id);
        return response()->json($project);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = $this->service->updateProject($id, $validated);
        return response()->json($project);
    }

    public function destroy($id)
    {
        $this->service->deleteProject($id);
        return response()->json(['message' => 'Dự án đã bị xóa']);
    }
}