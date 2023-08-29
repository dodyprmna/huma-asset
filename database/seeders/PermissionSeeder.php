<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'bangunan-list',
            'bangunan-create',
            'bangunan-edit',
            'bangunan-delete',
            'tanah-list',
            'tanah-create',
            'tanah-edit',
            'tanah-delete',
            'mesin-list',
            'mesin-create',
            'mesin-edit',
            'mesin-delete',
            'attb-list',
            'attb-create',
            'attb-edit',
            'attb-delete',
            'pbb-list',
            'pbb-create',
            'pbb-edit',
            'pbb-delete',
            'perlengkapan_umum-list',
            'perlengkapan_umum-create',
            'perlengkapan_umum-edit',
            'perlengkapan_umum-delete',
            'distribusi-list',
            'distribusi-create',
            'distribusi-edit',
            'distribusi-delete',
            'master_unit-list',
            'master_unit-create',
            'master_unit-edit',
            'master_unit-delete',
            'master_pegawai-list',
            'master_pegawai-create',
            'master_pegawai-edit',
            'master_pegawai-delete',
            'estimasi_biaya_pemeliharaan',

         ];
         
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission, 'guard_name' => 'web']);
         }
    }
}
