<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $skills = Skill::orderBy('level', 'desc')->get()->groupBy('category');
        $priorityOrder = [
            'Dashboard IoT',
            'Portofolio Website',
            'Website Laundry Mataram',
            'Enkripsi Data',
            'Manajemen Data Mahasiswa',
            'Reservasi Cafe',
            'Pemesanan Tiket Bola',
            'Pemesanan Laundry',
            'Sistem Laundry Mataram',
            'Landing Page Portofolio',
        ];

        $projects = Project::orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->sortBy(function (Project $project) use ($priorityOrder): int {
                $position = array_search($project->title, $priorityOrder, true);

                return $position === false ? count($priorityOrder) + 1 : $position;
            })
            ->values();

        return view('portfolio', compact('skills', 'projects'));
    }

    public function showProject(Project $project): View
    {
        $project->loadMissing();

        return view('portfolio-project', compact('project'));
    }

    public function storeContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Message::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim. Terima kasih!');
    }
}
