<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Misc
        $miscPermission = Permission::create(['name' => 'N/A']);

        // USER MODEL
        $userPermission1 = Permission::create(['name' => 'create user']);
        $userPermission2 = Permission::create(['name' => 'read user']);
        $userPermission3 = Permission::create(['name' => 'update user']);
        $userPermission4 = Permission::create(['name' => 'delete user']);

        // ROLE MODEL
        $rolePermission1 = Permission::create(['name' => 'create role']);
        $rolePermission2 = Permission::create(['name' => 'read role']);
        $rolePermission3 = Permission::create(['name' => 'update role']);
        $rolePermission4 = Permission::create(['name' => 'delete role']);

        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'create permission']);
        $permission2 = Permission::create(['name' => 'read permission']);
        $permission3 = Permission::create(['name' => 'update permission']);
        $permission4 = Permission::create(['name' => 'delete permission']);
        $permission5 = Permission::create(['name' => 'create offeredProgramme']);

        // ADMINS
        $adminPermission1 = Permission::create(['name' => 'read admin']);
        $adminPermission2 = Permission::create(['name' => 'update admin']);

        // CREATE ROLES
        $userRole1 = Role::create(['name' => 'LOCAL_STUDENT'])->syncPermissions([
            $miscPermission,
        ]);

        $userRole2 = Role::create(['name' => 'INTERNATIONAL_STUDENT'])->syncPermissions([
            $miscPermission,
        ]);

        $afoRole = Role::create(['name' => 'AFO'])->syncPermissions([
            $miscPermission,
        ]);

        $sroRole = Role::create(['name' => 'SRO'])->syncPermissions([
            $miscPermission,
        ]);

        $isoRole = Role::create(['name' => 'ISO'])->syncPermissions([
            $miscPermission,
        ]);

        $aaroRole = Role::create(['name' => 'AARO'])->syncPermissions([
            $permission5,
        ]);

        $superAdminRole = Role::create(['name' => 'SUPER_ADMIN'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $userPermission1,
        ]);

        $adminRole = Role::create(['name' => 'ADMIN'])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
            $userPermission1,
        ]);

        // CREATE ADMINS & USERS
        User::create([
            'name' => 'CCO_SUPERADMIN',
            'is_admin' => 1,
            'email' => 'ccooas@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('SouthernO@S2023'),
            'remember_token' => Str::random(10),
        ])->assignRole($superAdminRole);

        User::create([
            'name' => 'admin',
            'is_admin' => 1,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($adminRole);

        User::create([
            'name' => 'AFO_Tan Hui Pin',
            'is_admin' => 1,
            'email' => 'stf570@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($afoRole);

        User::create([
            'name' => 'AFO_Ang Kelly',
            'is_admin' => 1,
            'email' => 'stf9600@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($afoRole);

        User::create([
            'name' => 'AFO_Dan Ye Ling',
            'is_admin' => 1,
            'email' => 'stf9695@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($afoRole);

        User::create([
            'name' => 'AARO_Ng Yuen Ling',
            'is_admin' => 1,
            'email' => 'stf307@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($aaroRole);

        User::create([
            'name' => 'SRO_Pui Yong Chew',
            'is_admin' => 1,
            'email' => 'stf9825@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($sroRole);

        User::create([
            'name' => 'SRO_Toh Yi Hui',
            'is_admin' => 1,
            'email' => 'stf565@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($sroRole);

        User::create([
            'name' => 'SRO_Durgene Chandrasekaran',
            'is_admin' => 1,
            'email' => 'stf9782@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($sroRole);

        User::create([
            'name' => 'SRO_Reiko Tan Ling Er',
            'is_admin' => 1,
            'email' => 'stf9811@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($sroRole);

        User::create([
            'name' => 'SRO_Liew Yan Lin',
            'is_admin' => 1,
            'email' => 'stf9830@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($sroRole);

        User::create([
            'name' => 'SRO_Go Wei Kiat',
            'is_admin' => 1,
            'email' => 'stf428@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($sroRole);

        User::create([
            'name' => 'SRO_Azika Binti R. Abd. Aziz',
            'is_admin' => 1,
            'email' => 'stf9785@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($sroRole);

        User::create([
            'name' => 'ISO_Lai Chee Kuan',
            'is_admin' => 1,
            'email' => 'stf9773@sc.edu.my',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ])->assignRole($sroRole);

        for ($i=1; $i < 50; $i++) {
            User::create([
                'name' => 'Student '.$i,
                'is_admin' => 0,
                'email' => 'student'.$i.'@sc.edu.my',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // password
                'remember_token' => Str::random(10),
            ])->assignRole($userRole1);
        }
    }
}