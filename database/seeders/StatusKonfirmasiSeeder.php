<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysqli;

class StatusKonfirmasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $posts = [
            [
                'id' => "1",
                'status_konfirmasi' => "Pengajuan",
            ],

            [
                'id' => "2",
                'status_konfirmasi' => "Disetujui",
            ],

            [
                'id' => "3",
                'status_konfirmasi' => "Ditolak",
            ],

        ];
        DB::table('status_konfirmasis')->insert($posts);
        $status = [
            [
                'id' => "1",
                'ikon' => "<i class='bi bi-check-circle-fill'></i>",
                'status' => "Konfirmasi Anggota",
            ],

            [
                'id' => "2",
                'ikon' => "<i class='bi bi-check-circle-fill'></i>",
                'status' => "Ditolak",
            ],

            [
                'id' => "3",
                'ikon' => "<i class='bi bi-x-circle-fill'></i>",
                'status' => "Disetujui",
            ],
            [
                'id' => "4",
                'ikon' => "<i class='bi bi-file-earmark-break-fill'></i>",
                'status' => "DiKembalikan",
            ],
            [
                'id' => "5",
                'ikon' => "<i class='bi bi-exclamation-circle text-danger'></i>",
                'status' => "Diusulkan",
            ],
            [
                'id' => "6",
                'ikon' => "<i class='bi bi-file-earmark-break-fill'></i>",
                'status' => "Dikembalikan",
            ],

        ];
        DB::table('status')->insert($status);
    }
}
