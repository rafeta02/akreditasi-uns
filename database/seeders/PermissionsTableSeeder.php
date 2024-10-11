<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'title' => 'user_management_access',
            ],
            [
                'title' => 'permission_create',
            ],
            [
                'title' => 'permission_edit',
            ],
            [
                'title' => 'permission_show',
            ],
            [
                'title' => 'permission_delete',
            ],
            [
                'title' => 'permission_access',
            ],
            [
                'title' => 'role_create',
            ],
            [
                'title' => 'role_edit',
            ],
            [
                'title' => 'role_show',
            ],
            [
                'title' => 'role_delete',
            ],
            [
                'title' => 'role_access',
            ],
            [
                'title' => 'user_create',
            ],
            [
                'title' => 'user_edit',
            ],
            [
                'title' => 'user_show',
            ],
            [
                'title' => 'user_delete',
            ],
            [
                'title' => 'user_access',
            ],
            [
                'title' => 'audit_log_show',
            ],
            [
                'title' => 'audit_log_access',
            ],
            [
                'title' => 'master_akreditasi_access',
            ],
            [
                'title' => 'jenjang_create',
            ],
            [
                'title' => 'jenjang_edit',
            ],
            [
                'title' => 'jenjang_show',
            ],
            [
                'title' => 'jenjang_delete',
            ],
            [
                'title' => 'jenjang_access',
            ],
            [
                'title' => 'lembaga_akreditasi_create',
            ],
            [
                'title' => 'lembaga_akreditasi_edit',
            ],
            [
                'title' => 'lembaga_akreditasi_show',
            ],
            [
                'title' => 'lembaga_akreditasi_delete',
            ],
            [
                'title' => 'lembaga_akreditasi_access',
            ],
            [
                'title' => 'prodi_create',
            ],
            [
                'title' => 'prodi_edit',
            ],
            [
                'title' => 'prodi_show',
            ],
            [
                'title' => 'prodi_delete',
            ],
            [
                'title' => 'prodi_access',
            ],
            [
                'title' => 'akreditasi_create',
            ],
            [
                'title' => 'akreditasi_edit',
            ],
            [
                'title' => 'akreditasi_show',
            ],
            [
                'title' => 'akreditasi_delete',
            ],
            [
                'title' => 'akreditasi_access',
            ],
            [
                'title' => 'akreditasi_internasional_create',
            ],
            [
                'title' => 'akreditasi_internasional_edit',
            ],
            [
                'title' => 'akreditasi_internasional_show',
            ],
            [
                'title' => 'akreditasi_internasional_delete',
            ],
            [
                'title' => 'akreditasi_internasional_access',
            ],
            [
                'title' => 'ajuan_create',
            ],
            [
                'title' => 'ajuan_edit',
            ],
            [
                'title' => 'ajuan_show',
            ],
            [
                'title' => 'ajuan_delete',
            ],
            [
                'title' => 'ajuan_access',
            ],
            [
                'title' => 'faculty_create',
            ],
            [
                'title' => 'faculty_edit',
            ],
            [
                'title' => 'faculty_show',
            ],
            [
                'title' => 'faculty_delete',
            ],
            [
                'title' => 'faculty_access',
            ],
            [
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
