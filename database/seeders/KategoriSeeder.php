<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'kategoris' => 'A'
            ],
            [
                'kategoris' => 'B'
            ],
            [
                'kategoris' => 'C'
            ],
            [
                'kategoris' => 'D'
            ],
            [
                'kategoris' => 'E'
            ],
            [
                'kategoris' => 'F'
            ],
            [
                'kategoris' => 'G'
            ],
            [
                'kategoris' => 'H'
            ],
            [
                'kategoris' => 'I'
            ],
            [
                'kategoris' => 'J'
            ],
            [
                'kategoris' => 'K'
            ],
            [
                'kategoris' => 'L'
            ],
            [
                'kategoris' => 'M'
            ],
            [
                'kategoris' => 'N'
            ],
            [
                'kategoris' => 'O'
            ],
            [
                'kategoris' => 'P'
            ],
            [
                'kategoris' => 'Q'
            ],
            [
                'kategoris' => 'R'
            ],
            [
                'kategoris' => 'S'
            ],
            [
                'kategoris' => 'T'
            ],
            [
                'kategoris' => 'U'
            ],
            [
                'kategoris' => 'V'
            ],
            [
                'kategoris' => 'W'
            ],
            [
                'kategoris' => 'X'
            ],
            [
                'kategoris' => 'Y'
            ],
            [
                'kategoris' => 'Z'
            ],
        ];
        foreach ($kategoris as $kategori) {
            \App\Models\Kategori::create($kategori);
        }
    }
}
