<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = ["Pembina Tk. I","Pembina","Penata","Penata Tk. I"];

        for ($item=0; $item < count($states); $item++) {
            foreach ($states as $role) {
                $role = new Role;
                $role->nama_role = $states[$item];
                $role->timestamps = false;
                $role->save();
                $item+=1;
            }
        }
    }
}
