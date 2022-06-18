<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserTeacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ADMIN
        $admin = User::create([
            'name' => "Akun Admin",
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'is_admin' => 1,
        ]);

        // USER
        $user = User::create([
            'name' => "Akun Guru",
            'email' => 'user@mail.com',
            'password' => Hash::make('user123'),
        ]);

        UserTeacher::create([
            'user_id' => $user->id,
            'foto' => storage_path('/images/guru.png'),
            'kode_guru' => 'AG123',
            'nip' => 123456789,
            'nohp' => '08123456789',
            'alamat' => "Bt. Sangkar"
        ]);
    }
}
