<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'camilo',
            'email'             => 'camilo.oyarzodw@gmail.com',
            'password'          => bcrypt('Adm.Cencoc@l.256'),
        ]);
        $user = User::find(1);
        $user->assignRole(1);
    }
}
