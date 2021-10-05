<?php

namespace Database\Seeders;

use App\Models\Rakyat;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RakyatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Rakyat;
        $profile->name = 'rakyat';
        $profile->email = 'rakyat@mail.com';
        $profile->password = bcrypt('123456');
        $profile->created_at = Carbon::now();
        $profile->email_verified_at = Carbon::now();
        $profile->updated_at = Carbon::now();
        $profile->jenis_kelamin = 'L';
        $profile->save();
    }
}
