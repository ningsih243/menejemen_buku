<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus cache permission lama
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat permission (izin)
        $semuaPermission = [
            'lihat-buku', 'tambah-buku', 'edit-buku', 'hapus-buku', 'kelola-role',
        ];
        foreach ($semuaPermission as $nama) {
            Permission::firstOrCreate(['name' => $nama, 'guard_name' => 'web']);
        }

        // 2. Buat role (peran)
        $admin     = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $dosen     = Role::firstOrCreate(['name' => 'Dosen', 'guard_name' => 'web']);
        $mahasiswa = Role::firstOrCreate(['name' => 'Mahasiswa', 'guard_name' => 'web']);

        // 3. Hubungkan role dengan permission sesuai tabel tugas
        $admin->syncPermissions($semuaPermission);
        $dosen->syncPermissions(['lihat-buku', 'tambah-buku', 'edit-buku']);
        $mahasiswa->syncPermissions(['lihat-buku']);

        // 4. Buat 3 akun uji lalu beri role
        $akun = [
            ['Admin Uji',     'admin@example.com',     'Admin'],
            ['Dosen Uji',     'dosen@example.com',     'Dosen'],
            ['Mahasiswa Uji', 'mahasiswa@example.com', 'Mahasiswa'],
        ];
        foreach ($akun as [$nama, $email, $role]) {
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $nama, 'password' => Hash::make('password123')]
            );
            $user->syncRoles([$role]);
        }
    }
}