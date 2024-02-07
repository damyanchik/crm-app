<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);

        $user = User::where('email', 'admin@example.com')->first();
        $user->assignRole('admin');

        $permissions = Permission::pluck('name')->toArray();
        $adminRole->syncPermissions($permissions);
    }
}
