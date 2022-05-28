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
        $rakyatStates = array(
            array(
                "name" => "Rahman",
                "alamat" => "Jalan bali no 44",
                "email" => "rahman@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "email_verified_at" => Carbon::now(),
                "jenis_kelamin" => 'L',
                "no_telp" => "0878497632310"
            ),
            array(
                "name" => "Budi",
                "alamat" => "Jalan bali no 44",
                "email" => "budi@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "email_verified_at" => Carbon::now(),
                "jenis_kelamin" => 'L',
                "no_telp" => "087849631510"
            ),
            array(
                "name" => "Retno",
                "alamat" => "Jalan KH Abdul Karim no 10",
                "email" => "retno20@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "email_verified_at" => Carbon::now(),
                "jenis_kelamin" => 'P',
                "no_telp" => "0813094736109"
            ),
            array(
                "name" => "Jackie",
                "alamat" => "Jalan melati 22",
                "email" => "jacki3@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "email_verified_at" => Carbon::now(),
                "jenis_kelamin" => 'L',
                "no_telp" => "08528402847"
            ),
            array(
                "name" => "Mala",
                "alamat" => "Jalan Soekarno Hatta no 88",
                "email" => "mala@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "email_verified_at" => Carbon::now(),
                "jenis_kelamin" => 'P',
                "no_telp" => "0813468463193"
            ),
        );

        for ($item=0; $item < count($rakyatStates); $item++) {
            foreach ($rakyatStates as $profile) {
                $profile = new Rakyat;
                $profile->name = $rakyatStates[$item]['name'];
                $profile->alamat = $rakyatStates[$item]['alamat'];
                $profile->email = $rakyatStates[$item]['email'];
                $profile->password = $rakyatStates[$item]['password'];
                $profile->created_at = $rakyatStates[$item]['created_at'];
                $profile->email_verified_at = $rakyatStates[$item]['email_verified_at'];
                $profile->updated_at = $rakyatStates[$item]['updated_at'];
                $profile->jenis_kelamin = $rakyatStates[$item]['jenis_kelamin'];
                $profile->no_telp = $rakyatStates[$item]['no_telp'];
                $profile->save();
                $item+=1;
            }
        }
    }
}
