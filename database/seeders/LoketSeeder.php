<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loket;

class LoketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Loket::insert([
            "nama_lokets" => "Loket 1",
            "jenis_berobat" => "BPJS",
            "keterangan" => "Pasien BPJS",
            "id_dokter" => 1,
            "id_poli" => 1,
            "id_kategoris" => 1,
            "status" => "active",
        ]);

        Loket::insert([
            "nama_lokets" => "Loket 2",
            "jenis_berobat" => "UMUM",
            "keterangan" => "Pasien Umum",
            "id_dokter" => 1,
            "id_poli" => 2,
            "id_kategoris" => 2,
            "status" => "active",
        ]);
        Loket::insert([
            "nama_lokets" => "Loket 3",
            "jenis_berobat" => "BPJS",
            "keterangan" => "Pasien BPJS",
            "id_dokter" => 1,
            "id_poli" => 3,
            "id_kategoris" => 3,
            "status" => "active",
        ]);
    }
}
