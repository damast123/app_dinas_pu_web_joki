<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = new Jabatan;
        $jabatan->nama_jabatan = "pembina";
        $jabatan->timestamps = false;
        $jabatan->save();
    }
}
