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
        $dinasStates = array(
            array(
                "name" => "Chainur Rasyid",
                "alamat" => "",
                "email" => "admin@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "jabatan_id" => '1',
                "role_id" => '1',
            ),
            array(
                "name" => "Moh. Arifin Ismail",
                "alamat" => "Jalan mawar no 23",
                "email" => "adminmoharifin@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "jabatan_id" => '4',
                "role_id" => '2',
            ),
            array(
                "name" => "Hj. Sukartini",
                "alamat" => "Jalan KH Abdul Karim no 59",
                "email" => "adminsukartini@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "jabatan_id" => '3',
                "role_id" => '1',
            ),
            array(
                "name" => "H Suhairi",
                "alamat" => "Jalan sudirman 20",
                "email" => "adminsuhairi@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "jabatan_id" => '2',
                "role_id" => '2',
            ),
            array(
                "name" => "Noer Lisal Anbiyah",
                "alamat" => "Jalan Soekarno Hatta no 60",
                "email" => "adminnoerlisal@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "jabatan_id" => '5',
                "role_id" => '4',
            ),
            array(
                "name" => "Bazli",
                "alamat" => "Jalan Imam Bonjol no 25",
                "email" => "bazli@mail.com",
                "password" => bcrypt('123456'),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "jabatan_id" => '8',
                "role_id" => '2',
            ),
        );


        for ($item=0; $item < count($dinasStates); $item++) {
            foreach ($dinasStates as $profile) {
                $profile = new Dinas;
                $profile->name = $dinasStates[$item]['name'];
                $profile->alamat = $dinasStates[$item]['alamat'];
                $profile->email = $dinasStates[$item]['email'];
                $profile->password = $dinasStates[$item]['password'];
                $profile->created_at = $dinasStates[$item]['created_at'];
                $profile->updated_at = $dinasStates[$item]['updated_at'];
                $profile->jabatan_id = $dinasStates[$item]['jabatan_id'];
                $profile->role_id = $dinasStates[$item]['role_id'];
                $profile->save();
                $item+=1;
            }
        }
    }
}
