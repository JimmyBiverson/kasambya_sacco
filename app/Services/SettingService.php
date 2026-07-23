<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Log;

class SettingService
{
    /**
     * Retrieve a setting value by key, casting it to the appropriate PHP type.
     *
     * For type='encrypted', the stored ciphertext is decrypted via Laravel's
     * decrypt() helper. If decryption fails, a WARNING is logged and $default
     * is returned — the ciphertext and exception message are never exposed.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $setting = Setting::where('key', $key)->first();

        if ($setting === null) {
            return $default;
        }

        $raw = $setting->value;
        $type = $setting->type ?? 'string';

        if ($type === 'encrypted') {
            try {
                return decrypt($raw);
            } catch (DecryptException $e) {
                Log::warning("SettingService: failed to decrypt setting '{$key}'.", [
                    'key' => $key,
                ]);
                return $default;
            }
        }

        return $this->cast($raw, $type, $default);
    }

    /**
     * Persist a setting value by key.
     *
     * For type='encrypted', the value is encrypted before storage.
     * If the key does not yet exist in the database it is created;
     * otherwise the existing row is updated.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function set(string $key, mixed $value): void
    {
        $setting = Setting::firstOrNew(['key' => $key]);
        $type = $setting->type ?? 'string';

        if ($type === 'encrypted') {
            $setting->value = encrypt($value);
        } else {
            $setting->value = $this->serialize($value, $type);
        }

        $setting->save();
    }

    /**
     * Cast a raw string value to the specified PHP type.
     *
     * @param  string|null  $raw
     * @param  string       $type
     * @param  mixed        $default
     * @return mixed
     */
    private function cast(?string $raw, string $type, mixed $default): mixed
    {
        if ($raw === null) {
            return $default;
        }

        return match ($type) {
            'integer' => (int) $raw,
            'boolean' => filter_var($raw, FILTER_VALIDATE_BOOLEAN),
            'array'   => json_decode($raw, true) ?? $default,
            default   => $raw, // 'string' and any unknown types
        };
    }

    /**
     * Serialize a PHP value to a string for storage.
     *
     * @param  mixed   $value
     * @param  string  $type
     * @return string
     */
    private function serialize(mixed $value, string $type): string
    {
        return match ($type) {
            'boolean' => $value ? '1' : '0',
            'array'   => json_encode($value),
            default   => (string) $value,
        };
    }
}
