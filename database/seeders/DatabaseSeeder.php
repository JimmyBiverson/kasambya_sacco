<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@mybar.com'],
            [
                'name' => 'Mubende SACCO Admin',
                'email_verified_at' => now(),
                'password' => 'password123',
            ]
        );

        if ($adminUser->wasRecentlyCreated || $adminUser->email !== 'admin@mybar.com') {
            $adminUser->forceFill([
                'email' => 'admin@mybar.com',
                'name' => 'Mubende SACCO Admin',
                'password' => 'password123',
            ])->save();
        }

        $this->call([
            SettingSeeder::class,
            RolesAndPermissionsSeeder::class,
            ChartOfAccountSeeder::class,
            MemberSeeder::class,
        ]);

        $superAdminRole = Role::where('name', 'Super Admin')->first();
        if ($superAdminRole) {
            $adminUser->assignRole($superAdminRole);
        }
    }
}
