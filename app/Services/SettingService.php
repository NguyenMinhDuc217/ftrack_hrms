<?php 
namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService
{
    public function get($key, $default = null)
    {
        return Cache::rememberForever("settings.{$key}", function () use ($key, $default) {
            return Setting::where('key', $key)->value('value') ?? $default;
        });
    }

    public function set($key, $value)
    {
        Cache::forget("settings.{$key}");
        Setting::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}