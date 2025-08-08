<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokters = [
            [
                'nama_dokter' => 'Dokter Mamba ',
                'foto_dokter' => 'dokteramba.jpg',
                'id_poli' => 1,
            ],
            [
                'nama_dokter' => 'Dokter Budi',
                'foto_dokter' => 'dokterbudi.jpg',
                'id_poli' => 2,
            ],
            [
                'nama_dokter' => 'Dokter Cici',
                'foto_dokter' => 'doktercici.jpg',
                'id_poli' => 3,
            ],
                        [
                'nama_dokter' => 'Dokter Amba',
                'foto_dokter' => 'dokteramba.jpg',
                'id_poli' => 1,
            ],
            [
                'nama_dokter' => 'Dokter Budi',
                'foto_dokter' => 'dokterbudi.jpg',
                'id_poli' => 2,
            ],
            [
                'nama_dokter' => 'Dokter Cici',
                'foto_dokter' => 'doktercici.jpg',
                'id_poli' => 3,
            ],
                        [
                'nama_dokter' => 'Dokter Amba',
                'foto_dokter' => 'dokteramba.jpg',
                'id_poli' => 1,
            ],
            [
                'nama_dokter' => 'Dokter Budi',
                'foto_dokter' => 'dokterbudi.jpg',
                'id_poli' => 2,
            ],
            [
                'nama_dokter' => 'Dokter Cici',
                'foto_dokter' => 'doktercici.jpg',
                'id_poli' => 3,
            ],
                        [
                'nama_dokter' => 'Dokter Amba',
                'foto_dokter' => 'dokteramba.jpg',
                'id_poli' => 1,
            ],
            [
                'nama_dokter' => 'Dokter Budi',
                'foto_dokter' => 'dokterbudi.jpg',
                'id_poli' => 2,
            ],
            [
                'nama_dokter' => 'Dokter Cici',
                'foto_dokter' => 'doktercici.jpg',
                'id_poli' => 3,
            ],

        ];

        foreach ($dokters as $dokter) {
            Dokter::create($dokter);
        }
    }
}

