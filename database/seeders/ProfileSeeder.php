<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use Carbon\Carbon;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = new Profile;
        $profile->informasi_pu = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
        $profile->visi = 'Amet mattis vulputate enim nulla aliquet porttitor. Pulvinar etiam non quam lacus suspendisse faucibus interdum. Integer eget aliquet nibh praesent tristique. Vel elit scelerisque mauris pellentesque pulvinar. Gravida cum sociis natoque penatibus et magnis. Eget nunc lobortis mattis aliquam faucibus purus in massa. Faucibus vitae aliquet nec ullamcorper sit. Diam quam nulla porttitor massa id neque. Habitant morbi tristique senectus et netus et. Imperdiet nulla malesuada pellentesque elit eget gravida. Neque egestas congue quisque egestas diam in arcu. Vel eros donec ac odio tempor orci dapibus. Nunc congue nisi vitae suscipit tellus. Tempus quam pellentesque nec nam. Est ante in nibh mauris cursus mattis molestie. Est velit egestas dui id. Dictum non consectetur a erat nam at lectus urna duis. Lectus urna duis convallis convallis. Id donec ultrices tincidunt arcu non sodales. Sed id semper risus in hendrerit gravida rutrum quisque non.';
        $profile->misi = 'Lectus mauris ultrices eros in. Egestas tellus rutrum tellus pellentesque. Orci eu lobortis elementum nibh tellus molestie. Vel risus commodo viverra maecenas accumsan lacus vel. Turpis egestas sed tempus urna. At volutpat diam ut venenatis tellus. Eget est lorem ipsum dolor sit amet consectetur adipiscing. Lectus nulla at volutpat diam ut. Eget dolor morbi non arcu. Phasellus vestibulum lorem sed risus ultricies tristique. Vitae congue eu consequat ac felis. Posuere morbi leo urna molestie at elementum. Vehicula ipsum a arcu cursus.';
        $profile->struktur_organisasi = '';
        $profile->tugas_pokok = 'Sit amet consectetur adipiscing elit ut aliquam purus sit amet. Volutpat lacus laoreet non curabitur gravida arcu. Ligula ullamcorper malesuada proin libero nunc consequat. Nunc aliquet bibendum enim facilisis gravida neque convallis. Eget mi proin sed libero enim sed faucibus. Hac habitasse platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper. Porttitor eget dolor morbi non arcu risus. Viverra tellus in hac habitasse platea dictumst vestibulum rhoncus est. Mi ipsum faucibus vitae aliquet nec ullamcorper. Ac turpis egestas integer eget aliquet nibh. Fringilla urna porttitor rhoncus dolor purus. Elementum nisi quis eleifend quam adipiscing vitae proin sagittis nisl. Lobortis mattis aliquam faucibus purus in. Sapien eget mi proin sed libero enim sed. Turpis massa sed elementum tempus egestas sed sed. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant.';
        $profile->fungsi = 'Dolor sit amet consectetur adipiscing. Sit amet nisl suscipit adipiscing bibendum est ultricies integer quis. Quis auctor elit sed vulputate mi sit amet mauris. Mi bibendum neque egestas congue quisque egestas diam in arcu. Enim tortor at auctor urna nunc id cursus metus. Congue quisque egestas diam in arcu cursus euismod quis. Eu volutpat odio facilisis mauris. Vulputate mi sit amet mauris commodo quis imperdiet. Facilisis magna etiam tempor orci eu lobortis. Ut sem viverra aliquet eget sit amet tellus. Eget nulla facilisi etiam dignissim diam quis enim lobortis. Lacus laoreet non curabitur gravida arcu ac tortor. Urna porttitor rhoncus dolor purus non enim praesent. Tincidunt praesent semper feugiat nibh sed pulvinar proin gravida.';
        $profile->dinas_id = 1;
        $profile->created_at = Carbon::now();
        $profile->updated_at = Carbon::now();
        $profile->save();
    }
}
