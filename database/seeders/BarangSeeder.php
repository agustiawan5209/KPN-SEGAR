<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysqli;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat Seeder Lokasi
        $l = [
            'lantai'=> '2',
            'ruangan' => '206',
        ];
        DB::table('lokasi_penempatans')->insert($l);
        //
        // $posts = [
        //     [

        //         'id' => "1",
        //         'kode'=>"adminpusat1",
        //         'jenis_asets_id'=>"1",
        //         'jenis_barangs_id'=>"1",
        //         'asal_perolehans_id'=>"1",
        //         'satuans_id'=>"1",
        //         'nama_barang'=>"canon D312",
        //         'foto'=>"1.jpg",
        //         'kegunaan'=>"foto barang",
        //         'tanggal_perolehan'=>"2022-08-08",
        //         // 'nilai_perolehan'=>"120.000.000",
        //         'legalitas'=>"100",
        //         'luas'=>"100",
        //         'beban_penyusutan'=>"10%",
        //         'nilai_buku'=>"-",
        //         'lokasi'=>"1",
        //         'penanggung_jawab'=>"Staff ITB",
        //         'jumlah'=>"1",
        //         'kondisi'=>"1",
        //         'ket'=>"1",
        //         'created_at' => new \DateTime,
        //         'updated_at' => null,
        //     ],
        // ];
        // DB::table('barangs')->insert($posts);
    }
}
