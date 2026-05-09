<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'level',
        'icon',
        'color',
        'description',
        'years_experience',
        'is_featured',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'years_experience' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($skill) {
            if (empty($skill->slug)) {
                $skill->slug = Str::slug($skill->name);
            }
            
            $originalSlug = $skill->slug;
            $count = 1;
            while (static::where('slug', $skill->slug)->exists()) {
                $skill->slug = $originalSlug . '-' . $count++;
            }
        });
    }

    // Scopes
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
        return $query->orderBy('order', 'asc')->orderBy('level', 'desc');
    }

    public function scopeAdvanced($query)
    {
        return $query->where('level', '>=', 75);
    }

    // Accessors
    public function getCategoryLabelAttribute(): string
    {
        return config('portfolio.skills.categories.' . $this->category, $this->category);
    }

    public function getLevelLabelAttribute(): string
    {
        $levels = config('portfolio.skills.levels');
        
        foreach ($levels as $label => $range) {
            if ($this->level >= $range[0] && $this->level <= $range[1]) {
                return ucfirst($label);
            }
        }
        
        return 'Unknown';
    }

    public function getLevelColorAttribute(): string
    {
        return match(true) {
            $this->level >= 76 => 'green',
            $this->level >= 51 => 'blue',
            $this->level >= 26 => 'yellow',
            default => 'gray',
        };
    }

    public function getIconClassAttribute(): string
    {
        // If icon contains 'fa-', assume it's FontAwesome
        if ($this->icon && str_contains($this->icon, 'fa-')) {
            return $this->icon;
        }
        
        // Default icons by category
        return match($this->category) {
            'frontend' => 'fas fa-paint-brush',
            'backend' => 'fas fa-server',
            'mobile' => 'fas fa-mobile-alt',
            'database' => 'fas fa-database',
            'devops' => 'fas fa-cloud',
            'tools' => 'fas fa-tools',
            'soft-skill' => 'fas fa-users',
            default => 'fas fa-code',
        };
    }

    public function getYearsExperienceLabelAttribute(): ?string
    {
        if (!$this->years_experience) {
            return null;
        }

        return $this->years_experience . ' ' . Str::plural('year', $this->years_experience);
    }

    // Methods
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
