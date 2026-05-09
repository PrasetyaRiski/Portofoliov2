<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'short_description',
        'description',
        'featured_image',
        'gallery_images',
        'technologies',
        'demo_url',
        'github_url',
        'start_date',
        'end_date',
        'client',
        'is_featured',
        'status',
        'order',
        'views_count',
    ];

    protected function casts(): array
    {
        return [
            'gallery_images' => 'array',
            'technologies' => 'array',
            'start_date' => 'date',
            'end_date' => 'date',
            'is_featured' => 'boolean',
            'views_count' => 'integer',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
            
            // Ensure unique slug
            $originalSlug = $project->slug;
            $count = 1;
            while (static::where('slug', $project->slug)->exists()) {
                $project->slug = $originalSlug . '-' . $count++;
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title') && !$project->isDirty('slug')) {
                $project->slug = Str::slug($project->title);
                
                $originalSlug = $project->slug;
                $count = 1;
                while (static::where('slug', $project->slug)->where('id', '!=', $project->id)->exists()) {
                    $project->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return null;
    }

    public function getGalleryImagesUrlsAttribute(): array
    {
        if (!$this->gallery_images) {
            return [];
        }

        return array_map(function ($image) {
            return asset('storage/' . $image);
        }, $this->gallery_images);
    }

    public function getCategoryLabelAttribute(): string
    {
        return config('portfolio.projects.categories.' . $this->category, $this->category);
    }

    public function getStatusLabelAttribute(): string
    {
        return config('portfolio.projects.statuses.' . $this->status, $this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'published' => 'green',
            'draft' => 'yellow',
            'archived' => 'gray',
            default => 'gray',
        };
    }

    public function getDurationAttribute(): ?string
    {
        if (!$this->start_date) {
            return null;
        }

        $start = $this->start_date->format('M Y');
        $end = $this->end_date ? $this->end_date->format('M Y') : 'Present';
        
        return "$start - $end";
    }

    // Methods
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
