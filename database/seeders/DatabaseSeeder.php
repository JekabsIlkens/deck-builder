<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => RolesEnum::ADMIN->value]);
        $userRole = Role::create(['name' => RolesEnum::USER->value]);

        $manageUsers = Permission::create(['name' => PermissionsEnum::MANAGE_USERS->value]);
        $manageDecks = Permission::create(['name' => PermissionsEnum::MANAGE_DECKS->value]);

        $adminRole->givePermissionTo([$manageUsers, $manageDecks]);
        $userRole->givePermissionTo([$manageDecks]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
        ])->assignRole($adminRole);

        User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'),
        ])->assignRole($userRole);
    }
}
