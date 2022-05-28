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
            RakyatSeeder::class,
            DinasSeeder::class,
            ProfileSeeder::class,
            KategoriPengaduanSeeder::class,
            DaerahSeeder::class
        ]);
    }
}
