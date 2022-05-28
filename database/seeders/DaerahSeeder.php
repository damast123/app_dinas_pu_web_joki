<?php

namespace Database\Seeders;

use App\Models\Daerah;
use Illuminate\Database\Seeder;

class DaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = ["BANGKALAN","SAMPANG","PAMEKASAN","SUMENEP","KALIANGET"];

        for ($item=0; $item < count($states); $item++) {
            foreach ($states as $state) {
                $state = new Daerah;
                $state->nama_daerah = $states[$item];
                $state->save();
                $item+=1;
            }
        }
    }
}
