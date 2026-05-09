<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'level',
        'institution',
        'major',
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

    public function getLevelIconAttribute(): string
    {
        return match(strtolower($this->level)) {
            'sd' => 'fas fa-school',
            'smp' => 'fas fa-school',
            'sma', 'smk' => 'fas fa-graduation-cap',
            'universitas', 'd3', 'd4', 's1', 's2', 's3' => 'fas fa-university',
            default => 'fas fa-book',
        };
    }

    public function getLevelColorAttribute(): string
    {
        return match(strtolower($this->level)) {
            'sd' => 'yellow',
            'smp' => 'green',
            'sma', 'smk' => 'blue',
            'universitas', 'd3', 'd4', 's1', 's2', 's3' => 'purple',
            default => 'gray',
        };
    }
}
