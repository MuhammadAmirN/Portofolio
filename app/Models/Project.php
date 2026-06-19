<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'tech_stack',
        'image_path',
        'project_url',
        'github_url',
        'featured',
        'contribution_percentage',
    ];

    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'featured' => 'boolean',
            'contribution_percentage' => 'integer',
        ];
    }
}
