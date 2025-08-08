<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poli;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poliklinikData = [
            ['nama_poli' => 'Poli Umum', 'status_opc_ipc' => 'Aktif'],
            ['nama_poli' => 'Poli Gigi', 'status_opc_ipc' => 'Aktif'],
            ['nama_poli' => 'Poli Anak', 'status_opc_ipc' => 'Nonaktif'],
            // Add more data as needed
        ];

        foreach ($poliklinikData as $data) {
            Poli::create($data);
        }
    }
}

