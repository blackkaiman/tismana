<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key', 'value', 'type', 'group', 'label', 'sort_order',
    ];

    public static function get(string $key, $default = null): ?string
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting?->value ?? $default;
        });
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting.{$key}");
    }

    public static function getGroup(string $group): array
    {
        return static::where('group', $group)
            ->orderBy('sort_order')
            ->pluck('value', 'key')
            ->toArray();
    }

    protected static function booted(): void
    {
        static::saved(fn(Setting $s) => Cache::forget("setting.{$s->key}"));
        static::deleted(fn(Setting $s) => Cache::forget("setting.{$s->key}"));
    }
}
