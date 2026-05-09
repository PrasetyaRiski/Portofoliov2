<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'phone',
        'status',
        'read_at',
        'replied_at',
        'admin_notes',
        'ip_address',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'replied_at' => 'datetime',
        ];
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    public function scopeReplied($query)
    {
        return $query->where('status', 'replied');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getIsUnreadAttribute(): bool
    {
        return $this->status === 'unread';
    }

    public function getStatusBadgeAttribute(): array
    {
        return match($this->status) {
            'unread' => ['label' => 'Unread', 'color' => 'red'],
            'read' => ['label' => 'Read', 'color' => 'blue'],
            'replied' => ['label' => 'Replied', 'color' => 'green'],
            'archived' => ['label' => 'Archived', 'color' => 'gray'],
            default => ['label' => 'Unknown', 'color' => 'gray'],
        };
    }

    // Methods
    public function markAsRead(): void
    {
        $this->update([
            'status' => 'read',
            'read_at' => now(),
        ]);
    }

    public function markAsReplied(): void
    {
        $this->update([
            'status' => 'replied',
            'replied_at' => now(),
        ]);
    }

    public function archive(): void
    {
        $this->update(['status' => 'archived']);
    }
}
