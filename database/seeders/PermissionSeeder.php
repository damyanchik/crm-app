<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Permission::create(['name' => 'storeOffer']);
        Permission::create(['name' => 'updateOffer']);
        Permission::create(['name' => 'destroyOffer']);

        Permission::create(['name' => 'makeOrder']);
        Permission::create(['name' => 'readyOrder']);
        Permission::create(['name' => 'closeOrder']);
        Permission::create(['name' => 'rejectOrder']);

        Permission::create(['name' => 'storeProduct']);
        Permission::create(['name' => 'updateProduct']);
        Permission::create(['name' => 'destroyProduct']);

        Permission::create(['name' => 'storeBrand']);
        Permission::create(['name' => 'updateBrand']);
        Permission::create(['name' => 'destroyBrand']);

        Permission::create(['name' => 'storeProductCategory']);
        Permission::create(['name' => 'updateProductCategory']);
        Permission::create(['name' => 'destroyProductCategory']);

        Permission::create(['name' => 'storeClient']);
        Permission::create(['name' => 'updateClient']);
        Permission::create(['name' => 'destroyClient']);

        Permission::create(['name' => 'blockUser']);
        Permission::create(['name' => 'updateUser']);
        Permission::create(['name' => 'changePasswordUser']);
        Permission::create(['name' => 'deleteAvatarUser']);

        Permission::create(['name' => 'storeCalendar']);
        Permission::create(['name' => 'destroyCalendar']);

        Permission::create(['name' => 'viewAdmin']);
        Permission::create(['name' => 'companyDetailsAdmin']);
        Permission::create(['name' => 'employeeAdmin']);
        Permission::create(['name' => 'rolesPermissionsAdmin']);
        Permission::create(['name' => 'settingsAdmin']);
    }
}
