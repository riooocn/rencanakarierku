<?php

namespace App\Helpers;

class AssessmentHelper
{
    public static function getMinatDetail($code)
    {
        $map = [
            '1' => [
                'name' => 'Realistic',
                'letter' => 'R',
                'desc' => 'Praktis, suka bekerja dengan alat, mesin, atau aktivitas fisik di luar ruangan.',
            ],
            '2' => [
                'name' => 'Investigative',
                'letter' => 'I',
                'desc' => 'Pemikir, analitis, suka memecahkan masalah kompleks dan meneliti sains.',
            ],
            '3' => [
                'name' => 'Artistic',
                'letter' => 'A',
                'desc' => 'Kreatif, inovatif, suka mengekspresikan diri melalui seni atau ide original.',
            ],
            '4' => [
                'name' => 'Social',
                'letter' => 'S',
                'desc' => 'Pemberi bantuan, ramah, suka mengajar, membimbing, atau menyembuhkan orang lain.',
            ],
            '5' => [
                'name' => 'Enterprising',
                'letter' => 'E',
                'desc' => 'Penuh ambisi, energik, suka memimpin, memengaruhi orang lain, dan berbisnis.',
            ],
            '6' => [
                'name' => 'Conventional',
                'letter' => 'C',
                'desc' => 'Terorganisir, teliti, suka bekerja dengan data, angka, dan mengikuti prosedur baku.',
            ],
        ];

        return $map[$code] ?? ['name' => 'Unknown', 'letter' => '?', 'desc' => 'Tidak diketahui.'];
    }

    public static function getKapasitas1Detail($code)
    {
        $map = [
            '1' => [
                'name' => 'People',
                'desc' => 'Kapasitas bekerja dengan orang lain',
            ],
            '2' => [
                'name' => 'Data',
                'desc' => 'Kapasitas bekerja dengan angka dan informasi',
            ],
            '3' => [
                'name' => 'Things',
                'desc' => 'Kapasitas bekerja dengan alat atau objek',
            ],
            '4' => [
                'name' => 'Ideas',
                'desc' => 'Kapasitas memikirkan konsep dan kreativitas',
            ],
        ];

        return $map[$code] ?? ['name' => 'Unknown', 'desc' => 'Tidak diketahui.'];
    }

    public static function getNilaiKarierDetail($code)
    {
        $map = [
            '1' => [
                'name' => 'Leisure',
                'desc' => 'Menginginkan keseimbangan antara kehidupan kerja dan waktu luang.',
            ],
            '2' => [
                'name' => 'Extrinsic Rewards',
                'desc' => 'Menghargai penghasilan yang tinggi, status, dan keamanan finansial.',
            ],
            '3' => [
                'name' => 'Intrinsic Rewards',
                'desc' => 'Termotivasi oleh kepuasan batin dari pekerjaan itu sendiri.',
            ],
            '4' => [
                'name' => 'Altruistic Rewards',
                'desc' => 'Motivasi untuk membantu orang lain dan berkontribusi pada masyarakat.',
            ],
            '5' => [
                'name' => 'Social Rewards',
                'desc' => 'Menghargai interaksi sosial dan lingkungan kerja yang bersahabat.',
            ],
        ];

        return $map[$code] ?? ['name' => 'Unknown', 'desc' => 'Tidak diketahui.'];
    }
}
