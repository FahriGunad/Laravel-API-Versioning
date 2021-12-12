<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('level')->insert([
            'nama_level' => 'administrator',
        ]);

        DB::table('level')->insert([
            'nama_level' => 'petugas',
        ]);

        DB::table('level')->insert([
            'nama_level' => 'pegawai',
        ]);

        DB::table('petugas')->insert([
            'nama_petugas' => 'name',
            'username' => 'name',
            'password' => bcrypt('name'),
            'id_level' => '1',
        ]);
    }
}
