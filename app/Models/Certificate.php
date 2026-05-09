<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Certificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'issuer',
        'category',
        'description',
        'issue_date',
        'expiry_date',
        'credential_id',
        'credential_url',
        'logo_path',
        'certificate_image',
        'skills_covered',
        'is_verified',
        'is_featured',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
            'expiry_date' => 'date',
            'skills_covered' => 'array',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificate) {
            if (empty($certificate->slug)) {
                $certificate->slug = Str::slug($certificate->title . '-' . $certificate->issuer);
            }
            
            $originalSlug = $certificate->slug;
            $count = 1;
            while (static::where('slug', $certificate->slug)->exists()) {
                $certificate->slug = $originalSlug . '-' . $count++;
            }
        });
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByIssuer($query, $issuer)
    {
        return $query->where('issuer', $issuer);
    }

    public function scopeValid($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expiry_date')
              ->orWhere('expiry_date', '>=', now());
        });
    }

    public function scopeExpired($query)
    {
        return $query->where('expiry_date', '<', now());
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('issue_date', 'desc');
    }

    // Accessors
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo_path) {
            return asset('storage/' . $this->logo_path);
        }
        return null;
    }

    public function getCertificateImageUrlAttribute(): ?string
    {
        if ($this->certificate_image) {
            return asset('storage/' . $this->certificate_image);
        }
        return null;
    }

    // Alias for views using image_url
    public function getImageUrlAttribute(): ?string
    {
        return $this->certificate_image_url;
    }

    // Alias for views checking image property
    public function getImageAttribute(): ?string
    {
        return $this->certificate_image;
    }

    public function getCategoryLabelAttribute(): string
    {
        return config('portfolio.certificates.categories.' . $this->category, $this->category);
    }

    public function getIsExpiredAttribute(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }
        return $this->expiry_date->isPast();
    }

    public function getIsExpiringAttribute(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }
        return $this->expiry_date->isBetween(now(), now()->addMonths(3));
    }

    public function getValidityStatusAttribute(): string
    {
        if (!$this->expiry_date) {
            return 'lifetime';
        }
        
        if ($this->is_expired) {
            return 'expired';
        }
        
        if ($this->is_expiring) {
            return 'expiring';
        }
        
        return 'valid';
    }

    public function getValidityBadgeAttribute(): array
    {
        return match($this->validity_status) {
            'lifetime' => ['label' => 'No Expiry', 'color' => 'blue'],
            'valid' => ['label' => 'Valid', 'color' => 'green'],
            'expiring' => ['label' => 'Expiring Soon', 'color' => 'yellow'],
            'expired' => ['label' => 'Expired', 'color' => 'red'],
            default => ['label' => 'Unknown', 'color' => 'gray'],
        };
    }

    public function getFormattedIssueDateAttribute(): string
    {
        return $this->issue_date->format('F Y');
    }

    public function getFormattedExpiryDateAttribute(): ?string
    {
        return $this->expiry_date?->format('F Y');
    }

    // Methods
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
