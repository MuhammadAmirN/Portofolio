<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Message;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'skills_count' => Skill::count(),
            'projects_count' => Project::count(),
            'messages_count' => Message::count(),
            'unread_messages' => Message::where('status', 'unread')->count(),
        ];

        $recentMessages = Message::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages'));
    }
}
