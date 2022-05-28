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
        $states = ["Kepala Dinas PU.SDA","Sekretaris","KASUBAG PERENCANAAN, PROGRAM, DAN KEUANGAN","KASUBAG UMUM, KEARSIPAN DAN KEPEGAWAIAN","Bidang Waduk, Sungai dan Pantai","Bidang Perencanaan Pengembangan Sumber Daya Air dan Bina Manfaat","Bidang irigasi","Admin"];

        for ($item=0; $item < count($states); $item++) {
            foreach ($states as $jabatan) {
                $jabatan = new Jabatan;
                $jabatan->nama_jabatan = $states[$item];
                $jabatan->timestamps = false;
                $jabatan->save();
                $item+=1;
            }
        }
    }
}
