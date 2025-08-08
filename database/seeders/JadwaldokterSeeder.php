<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwaldokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Jadwaldokter::insert([
            [
                'id_dokter' => 1,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'hari' => 'senin'
            ],
            [
                'id_dokter' => 2,
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'hari' => 'senin'
            ],
            [
                'id_dokter' => 3,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'hari' => 'selasa'
            ],

        ]);
    }
}
