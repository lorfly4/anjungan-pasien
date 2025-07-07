<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class jadwal_dokter extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Jadwaldokter::insert([
            ...collect(range(25, 27))
                ->flatMap(function ($id) {
                    return [
                        [
                            'id_dokter' => $id,
                            'jam_mulai' => '08:00',
                            'jam_selesai' => '12:00',
                            'hari' => 'Senin'
                        ],
                        [
                            'id_dokter' => $id,
                            'jam_mulai' => '08:00',
                            'jam_selesai' => '12:00',
                            'hari' => 'Senin'
                        ],
                        [
                            'id_dokter' => $id,
                            'jam_mulai' => '08:00',
                            'jam_selesai' => '12:00',
                            'hari' => 'Selasa'
                        ],
                        [
                            'id_dokter' => $id,
                            'jam_mulai' => '08:00',
                            'jam_selesai' => '12:00',
                            'hari' => 'Rabu'
                        ],
                        [
                            'id_dokter' => $id,
                            'jam_mulai' => '08:00',
                            'jam_selesai' => '12:00',
                            'hari' => 'Kamis'
                        ],
                        [
                            'id_dokter' => $id,
                            'jam_mulai' => '08:00',
                            'jam_selesai' => '12:00',
                            'hari' => 'Jumat'
                        ],
                        [
                            'id_dokter' => $id,
                            'jam_mulai' => '08:00',
                            'jam_selesai' => '12:00',
                            'hari' => 'Sabtu'
                        ],
                        [
                            'id_dokter' => $id,
                            'jam_mulai' => '08:00',
                            'jam_selesai' => '12:00',
                            'hari' => 'Minggu'
                        ],
                    ];
                })->all(),

        ]);
    }
}