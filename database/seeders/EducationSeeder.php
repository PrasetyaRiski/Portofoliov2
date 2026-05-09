<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        $educations = [
            [
                'level' => 'Universitas',
                'institution' => 'Universitas Muhammadiyah Ponorogo',
                'major' => 'Teknik Informatika',
                'location' => 'Jl. Budi Utomo No.10, Ronowijayan, Kec. Ponorogo, Kabupaten Ponorogo, Jawa Timur 63471',
                'description' => 'Sedang menempuh pendidikan S1 Teknik Informatika.',
                'start_year' => '2023',
                'end_year' => null,
                'is_current' => true,
                'order' => 1,
            ],
            [
                'level' => 'SMK',
                'institution' => 'SMKN 1 Slahung',
                'major' => 'Teknik Komputer dan Jaringan',
                'location' => 'Jl. Macan Tutul, Galak, Kec. Slahung, Kabupaten Ponorogo, Jawa Timur 63463',
                'description' => 'Lulus dari jurusan Teknik Komputer dan Jaringan.',
                'start_year' => '2020',
                'end_year' => '2023',
                'is_current' => false,
                'order' => 2,
            ],
            [
                'level' => 'SMP',
                'institution' => 'SMPN 1 Slahung',
                'major' => null,
                'location' => 'Desa Menggare, Slahung, Krajan, Menggare, Ponorogo, Kabupaten Ponorogo, Jawa Timur 63463',
                'description' => 'Menyelesaikan pendidikan menengah pertama.',
                'start_year' => '2018',
                'end_year' => '2020',
                'is_current' => false,
                'order' => 3,
            ],
            [
                'level' => 'SD',
                'institution' => 'SDN 4 Slahung',
                'major' => null,
                'location' => 'Jl. Mrayan, Gembes, Slahung, Kec. Slahung, Kabupaten Ponorogo, Jawa Timur 63463',
                'description' => 'Menyelesaikan pendidikan dasar.',
                'start_year' => '2011',
                'end_year' => '2018',
                'is_current' => false,
                'order' => 4,
            ],
        ];

        foreach ($educations as $education) {
            Education::create($education);
        }
    }
}
