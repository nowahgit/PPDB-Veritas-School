<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        /*
        |--------------------------------------------------------------------------
        | ADMIN PPDB
        |--------------------------------------------------------------------------
        */
        $adminData = [
            ['username' => 'admin', 'email' => 'admin@ppdbveritas.sch.id', 'no_hp' => '081234567890'],
            ['username' => 'panitia1', 'email' => 'panitia1@ppdbveritas.sch.id', 'no_hp' => '081234567891'],
            ['username' => 'panitia2', 'email' => 'panitia2@ppdbveritas.sch.id', 'no_hp' => '081234567892'],
        ];

        foreach ($adminData as $data) {
            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make('admin123'),
                'role' => 'ADMIN',
                'no_hp' => $data['no_hp'],
            ]);

            Admin::create([
                'user_id' => $user->id,
                'nama_panitia' => strtoupper($data['username']),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PENDAFTAR DUMMY (SIMULASI REAL PPDB)
        |--------------------------------------------------------------------------
        */
        $agamaList = ['Kristen', 'Katolik', 'Islam', 'Hindu', 'Buddha'];
        $pekerjaanOrtu = ['Guru', 'Petani', 'PNS', 'Karyawan', 'Pedagang', 'Dokter', 'Wiraswasta'];
        $statusList = ['pending', 'lolos', 'tidak_lolos'];

        for ($i = 1; $i <= 200; $i++) {

            $nama = $faker->name();
            $username = strtolower(str_replace(' ', '', $faker->firstName())) . rand(100, 999);

            $nisn = $faker->unique()->numerify('00########');
            $tgl_lahir = $faker->dateTimeBetween('-18 years', '-10 years')->format('Y-m-d');

            $nilai = [
                $faker->randomFloat(2, 70, 98),
                $faker->randomFloat(2, 70, 98),
                $faker->randomFloat(2, 70, 98),
                $faker->randomFloat(2, 70, 98),
                $faker->randomFloat(2, 70, 98),
            ];

            User::create([
                'username' => $username,
                'email' => $username . '@gmail.com',
                'password' => Hash::make('user123'),
                'role' => 'PENDAFTAR',

                // DATA SISWA
                'nisn_pendaftar' => $nisn,
                'nama_pendaftar' => $nama,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tanggallahir_pendaftar' => $tgl_lahir,
                'alamat_pendaftar' => $faker->address(),
                'agama' => $faker->randomElement($agamaList),

                // PRESTASI (REALISTIS)
                'prestasi' => $faker->randomElement([
                    'Juara 1 Olimpiade Matematika',
                    'Juara 2 Lomba Sains',
                    'Juara 3 Cerdas Cermat',
                    null,
                ]),

                // ORANG TUA
                'nama_ortu' => $faker->name(),
                'pekerjaan_ortu' => $faker->randomElement($pekerjaanOrtu),
                'no_hp_ortu' => '08' . $faker->numberBetween(1000000000, 9999999999),
                'alamat_ortu' => $faker->address(),

                // KONTAK
                'no_hp' => '08' . $faker->numberBetween(1000000000, 9999999999),

                // NILAI RAPOR
                'nilai_smt1' => $nilai[0],
                'nilai_smt2' => $nilai[1],
                'nilai_smt3' => $nilai[2],
                'nilai_smt4' => $nilai[3],
                'nilai_smt5' => $nilai[4],

                // STATUS SELEKSI
                'status' => $faker->randomElement($statusList),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
