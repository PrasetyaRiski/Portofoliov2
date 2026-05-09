<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
    ];

    // Static methods for easy access
    public static function get(string $key, $default = null)
    {
        $setting = Cache::rememberForever("setting_{$key}", function () use ($key) {
            return static::where('key', $key)->first();
        });

        if (!$setting) {
            return $default;
        }

        return static::castValue($setting->value, $setting->type);
    }

    public static function set(string $key, $value, string $type = 'text', string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => is_array($value) ? json_encode($value) : $value,
                'type' => $type,
                'group' => $group,
            ]
        );

        Cache::forget("setting_{$key}");
    }

    public static function getGroup(string $group): array
    {
        return Cache::rememberForever("settings_group_{$group}", function () use ($group) {
            return static::where('group', $group)
                ->get()
                ->mapWithKeys(function ($setting) {
                    return [$setting->key => static::castValue($setting->value, $setting->type)];
                })
                ->toArray();
        });
    }

    protected static function castValue($value, string $type)
    {
        return match($type) {
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'number' => (int) $value,
            'json' => json_decode($value, true),
            default => $value,
        };
    }

    public static function clearCache(): void
    {
        $keys = static::pluck('key');
        
        foreach ($keys as $key) {
            Cache::forget("setting_{$key}");
        }
        
        $groups = static::distinct()->pluck('group');
        foreach ($groups as $group) {
            Cache::forget("settings_group_{$group}");
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($setting) {
            Cache::forget("setting_{$setting->key}");
            Cache::forget("settings_group_{$setting->group}");
        });

        static::deleted(function ($setting) {
            Cache::forget("setting_{$setting->key}");
            Cache::forget("settings_group_{$setting->group}");
        });
    }
}
