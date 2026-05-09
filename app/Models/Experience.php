<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'organization',
        'location',
        'description',
        'start_year',
        'end_year',
        'is_current',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'is_current' => 'boolean',
        ];
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('start_year', 'desc');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }

    // Accessors
    public function getPeriodAttribute(): string
    {
        $end = $this->is_current ? 'Sekarang' : $this->end_year;
        return "{$this->start_year} - {$end}";
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'organization' => 'Organisasi',
            'internship' => 'PKL / Magang',
            'extracurricular' => 'Ekstrakurikuler',
            'volunteer' => 'Volunteer',
            'work' => 'Pekerjaan',
            default => ucfirst($this->type),
        };
    }

    public function getTypeIconAttribute(): string
    {
        return match($this->type) {
            'organization' => 'fas fa-users',
            'internship' => 'fas fa-briefcase',
            'extracurricular' => 'fas fa-star',
            'volunteer' => 'fas fa-hand-holding-heart',
            'work' => 'fas fa-building',
            default => 'fas fa-certificate',
        };
    }

    public function getTypeColorAttribute(): string
    {
        return match($this->type) {
            'organization' => 'blue',
            'internship' => 'green',
            'extracurricular' => 'purple',
            'volunteer' => 'pink',
            'work' => 'orange',
            default => 'gray',
        };
    }
}
