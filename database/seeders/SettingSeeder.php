<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Seed the required application settings.
     *
     * Each row is upserted by key so the seeder is safe to re-run.
     *
     * Requirements: 1.6, 21.1, 21.2, 21.3, 21.4, 21.5
     */
    public function run(): void
    {
        $settings = [
            // Organisation identity
            ['key' => 'org_name',                'group' => 'organisation', 'type' => 'string',    'value' => 'Mubende Employees and Community SACCO Ltd'],
            ['key' => 'org_logo',                'group' => 'organisation', 'type' => 'string',    'value' => ''],
            ['key' => 'org_address',             'group' => 'organisation', 'type' => 'string',    'value' => ''],
            ['key' => 'org_phone',               'group' => 'organisation', 'type' => 'string',    'value' => ''],
            ['key' => 'org_email',               'group' => 'organisation', 'type' => 'string',    'value' => ''],
            ['key' => 'org_registration_number', 'group' => 'organisation', 'type' => 'string',    'value' => '6682'],
            ['key' => 'operating_hours',         'group' => 'organisation', 'type' => 'string',    'value' => 'Mon–Fri 08:00–17:00'],

            // Theme
            ['key' => 'theme_primary_color',     'group' => 'theme',        'type' => 'string',    'value' => '#1a6e3e'],
            ['key' => 'theme_accent_color',      'group' => 'theme',        'type' => 'string',    'value' => '#f59e0b'],

            // SMS / Africa's Talking
            ['key' => 'sms_provider',            'group' => 'sms',          'type' => 'string',    'value' => 'africastalking'],
            ['key' => 'sms_api_key',             'group' => 'sms',          'type' => 'encrypted', 'value' => ''],

            // Mail / SMTP
            ['key' => 'smtp_host',               'group' => 'mail',         'type' => 'string',    'value' => ''],
            ['key' => 'smtp_port',               'group' => 'mail',         'type' => 'integer',   'value' => '587'],
            ['key' => 'smtp_user',               'group' => 'mail',         'type' => 'string',    'value' => ''],
            ['key' => 'smtp_password',           'group' => 'mail',         'type' => 'encrypted', 'value' => ''],

            // SEO
            ['key' => 'meta_description',        'group' => 'seo',          'type' => 'string',    'value' => 'Mubende Employees and Community SACCO Ltd — empowering our community through savings and credit in Mubande great region.'],
        ];

        foreach ($settings as $data) {
            Setting::updateOrCreate(
                ['key' => $data['key']],
                [
                    'group' => $data['group'],
                    'type'  => $data['type'],
                    'value' => $data['value'],
                ]
            );
        }
    }
}
