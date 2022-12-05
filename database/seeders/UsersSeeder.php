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
                'name'=>"pengurus",
                'roles_id'=>"1",
                'username'=>"pengurus",
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
                'name'=>"bendahara",
                'roles_id'=>"4",
                'username'=>"bendahara",
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
                'name'=>"Anggota",
                'roles_id'=>"2",
                'username'=>"Anggota",
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
                'name'=>"pengguna",
                'roles_id'=>"3",
                'username'=>"pengguna",
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
