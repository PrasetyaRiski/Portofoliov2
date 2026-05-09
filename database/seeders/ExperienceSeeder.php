<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'title' => 'Pengurus HIMAKA',
                'type' => 'organization',
                'organization' => 'Universitas Muhammadiyah Ponorogo',
                'location' => 'Jl. Budi Utomo No.10, Ronowijayan, Kec. Ponorogo, Kabupaten Ponorogo, Jawa Timur 63471',
                'description' => 'Aktif sebagai pengurus Himpunan Mahasiswa Komunikasi (HIMAKA) di Universitas Muhammadiyah Ponorogo.',
                'start_year' => '2024',
                'end_year' => null,
                'is_current' => true,
                'order' => 1,
            ],
            [
                'title' => 'Servis Komputer',
                'type' => 'internship',
                'organization' => 'MATS KOMPUTER',
                'location' => 'Sambit, Ponorogo',
                'description' => 'Praktik Kerja Lapangan (PKL) di bidang servis dan perbaikan komputer.',
                'start_year' => '2022',
                'end_year' => '2022',
                'is_current' => false,
                'order' => 2,
            ],
            [
                'title' => 'Jurnalistik',
                'type' => 'extracurricular',
                'organization' => 'SMKN 1 Slahung Ponorogo',
                'location' => 'Jl. Macan Tutul, Galak, Kec. Slahung, Kabupaten Ponorogo, Jawa Timur 63463',
                'description' => 'Anggota ekstrakurikuler Jurnalistik, aktif dalam kegiatan dokumentasi dan penulisan berita sekolah.',
                'start_year' => '2021',
                'end_year' => '2021',
                'is_current' => false,
                'order' => 3,
            ],
            [
                'title' => 'Pengurus OSIS',
                'type' => 'organization',
                'organization' => 'SMKN 1 Slahung',
                'location' => 'Jl. Macan Tutul, Galak, Kec. Slahung, Kabupaten Ponorogo, Jawa Timur 63463',
                'description' => 'Aktif sebagai pengurus Organisasi Siswa Intra Sekolah (OSIS) di SMKN 1 Slahung.',
                'start_year' => '2020',
                'end_year' => '2022',
                'is_current' => false,
                'order' => 4,
            ],
            [
                'title' => 'Pengurus OSIS',
                'type' => 'organization',
                'organization' => 'SMPN 1 Slahung',
                'location' => 'Desa Menggare, Slahung, Krajan, Menggare, Ponorogo, Kabupaten Ponorogo, Jawa Timur 63463',
                'description' => 'Aktif sebagai pengurus Organisasi Siswa Intra Sekolah (OSIS) di SMPN 1 Slahung.',
                'start_year' => '2019',
                'end_year' => '2020',
                'is_current' => false,
                'order' => 5,
            ],
            [
                'title' => 'Dewan Galang Pramuka',
                'type' => 'organization',
                'organization' => 'SMPN 1 Slahung',
                'location' => 'Desa Menggare, Slahung, Krajan, Menggare, Ponorogo, Kabupaten Ponorogo, Jawa Timur 63463',
                'description' => 'Anggota Dewan Galang Pramuka di SMPN 1 Slahung, aktif dalam kegiatan kepramukaan.',
                'start_year' => '2019',
                'end_year' => '2020',
                'is_current' => false,
                'order' => 6,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }
}
