<?php

namespace Database\Seeders;

use App\Models\KategoriPengaduan;
use Illuminate\Database\Seeder;

class KategoriPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = ["Kesehatan","Teknologi Informasi Dan Komunikasi","Sosial","Energi Dan Sumber Daya Alam","Pembangunan"];

        for ($item=0; $item < count($states); $item++) {
            foreach ($states as $state) {
                $state = new KategoriPengaduan;
                $state->nama = $states[$item];
                $state->save();
                $item+=1;
            }
        }
    }
}
