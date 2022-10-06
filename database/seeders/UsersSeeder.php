<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysqli;

class UsersSeeder extends Seeder
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
                'name'=>"adminpusat1",
                'roles_id'=>"1",
                'username'=>"adminpusat1",
                'alamat'=>"Makassar, Sulawesi Selatan",
                'posisi'=>"admin",
                'telephone'=>"0811111",
                'password' => bcrypt('12345678'),
                  'status'=>"1",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

            [
                'id' => "2",
                'name'=>"adminpusat2",
                'roles_id'=>"1",
                'username'=>"adminpusat2",
                'alamat'=>"Makassar, Sulawesi Selatan",
                'posisi'=>"admin",
                'telephone'=>"0821111",
                'password' => bcrypt('12345678'),
                 'status'=>"1",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

            [
                'id' => "3",
                'name'=>"admincabang1",
                'roles_id'=>"1",
                'username'=>"admincabang1",
                'alamat'=>"Makassar, Sulawesi Selatan",
                'posisi'=>"admin",
                'telephone'=>"0811121",
                'password' => bcrypt('12345678'),
                'status'=>"1",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => "4",
                'name'=>"peminjam",
                'roles_id'=>"3",
                'username'=>"peminjam",
                'alamat'=>"Makassar, Sulawesi Selatan",
                'posisi'=>"staff ahli",
                'telephone'=>"0811113",
                'password' => bcrypt('12345678'),
                 'status'=>"1",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],



        ];
        DB::table('users')->insert($posts);
    }
}
