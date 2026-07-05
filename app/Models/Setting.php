<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    /**
     * Retrieve a setting value by key.
     *
     * Returns the stored value string, or $default if the key does not exist.
     * Type casting is handled by SettingService; this helper returns the raw value.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();

        if ($setting === null) {
            return $default;
        }

        return $setting->value;
    }
}
