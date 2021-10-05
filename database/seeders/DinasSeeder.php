<?php

namespace Database\Seeders;

use App\Models\Dinas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Dinas;
        $profile->name = 'admin';
        $profile->email = 'admin@mail.com';
        $profile->password = bcrypt('123456');
        $profile->created_at = Carbon::now();
        $profile->updated_at = Carbon::now();
        $profile->jabatan_id = '1';
        $profile->role_id = '1';
        $profile->save();
    }
}
