<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            JabatanSeeder::class,
            DinasSeeder::class,
            RakyatSeeder::class,
            ProfileSeeder::class,
            KategoriPengaduanSeeder::class,
            DaerahSeeder::class
        ]);
    }
}
