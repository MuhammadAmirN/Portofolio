<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class AdminProjectController extends Controller
{
    public function sync()
    {
        try {
            Artisan::call('app:sync-github-projects', [
                'username' => 'MuhammadAmirN'
            ]);
            return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil disinkronisasi dari GitHub.');
        } catch (\Exception $e) {
            return redirect()->route('admin.projects.index')->with('error', 'Gagal sinkronisasi: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'required|string', // Comma separated, we will parse into array
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'project_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'featured' => 'nullable|boolean',
            'contribution_percentage' => 'required|integer|between:0,100',
        ]);

        // Parse tech_stack from comma-separated string to array
        $techStackArray = array_filter(array_map('trim', explode(',', $validated['tech_stack'])));

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . rand(1000, 9999),
            'description' => $validated['description'],
            'tech_stack' => $techStackArray,
            'project_url' => $validated['project_url'],
            'github_url' => $validated['github_url'],
            'featured' => $request->has('featured'),
            'contribution_percentage' => $validated['contribution_percentage'],
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $data['image_path'] = $path;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'project_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'featured' => 'nullable|boolean',
            'contribution_percentage' => 'required|integer|between:0,100',
        ]);

        $techStackArray = array_filter(array_map('trim', explode(',', $validated['tech_stack'])));

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . substr($project->slug, -4),
            'description' => $validated['description'],
            'tech_stack' => $techStackArray,
            'project_url' => $validated['project_url'],
            'github_url' => $validated['github_url'],
            'featured' => $request->has('featured'),
            'contribution_percentage' => $validated['contribution_percentage'],
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
                Storage::disk('public')->delete($project->image_path);
            }
            $path = $request->file('image')->store('projects', 'public');
            $data['image_path'] = $path;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
            Storage::disk('public')->delete($project->image_path);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Proyek berhasil dihapus.');
    }
}
