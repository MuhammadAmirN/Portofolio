<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncGithubProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-github-projects {username=MuhammadAmirN}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync public repositories from GitHub into the projects table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->argument('username');
        $this->info("Fetching repositories for {$username}...");

        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'User-Agent' => 'Laravel-Portfolio-Sync',
            'Accept' => 'application/vnd.github.v3+json',
        ])->get("https://api.github.com/users/{$username}/repos?per_page=100&sort=updated");

        if ($response->failed()) {
            $this->error("Failed to fetch repositories from GitHub: " . $response->body());
            return 1;
        }

        $repos = $response->json();
        $count = 0;

        foreach ($repos as $repo) {
            // Skip forks
            if ($repo['fork']) {
                continue;
            }

            $title = str_replace(['-', '_'], ' ', $repo['name']);
            $title = ucwords($title);

            // Tech stack from language and topics
            $techStack = [];
            if ($repo['language']) {
                $techStack[] = $repo['language'];
            }
            
            // Map topics to tech stack if available
            if (isset($repo['topics']) && is_array($repo['topics'])) {
                $techStack = array_merge($techStack, $repo['topics']);
            }
            
            $techStack = array_unique(array_filter($techStack));

            $data = [
                'title' => $title,
                'description' => $repo['description'] ?: "Proyek {$title} yang dihosting di GitHub.",
                'tech_stack' => $techStack,
                'github_url' => $repo['html_url'],
                'project_url' => $repo['homepage'],
                'featured' => $repo['stargazers_count'] > 5, // Mark as featured if it has some stars
                'contribution_percentage' => 100,
            ];

            // Only set slug if it's a new project
            $project = \App\Models\Project::where('github_url', $repo['html_url'])->first();
            
            if (!$project) {
                $data['slug'] = \Illuminate\Support\Str::slug($title) . '-' . rand(1000, 9999);
                \App\Models\Project::create($data);
                $this->line("Created: {$title}");
                $count++;
            } else {
                // Update existing project but don't overwrite manually set image or featured status if already true
                unset($data['featured']); // Don't overwrite featured status
                $project->update($data);
                $this->line("Updated: {$title}");
            }
        }

        $this->info("Successfully synced {$count} new repositories.");
        return 0;
    }
}
