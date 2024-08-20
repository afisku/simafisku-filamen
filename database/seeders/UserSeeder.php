<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'sgus', 'email' => 'agussmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'ahmad', 'email' => 'ahmadsmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'ana', 'email' => 'anasmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'ardi', 'email' => 'ardismpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'dian', 'email' => 'dianfaqih@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'edi', 'email' => 'smpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'erik', 'email' => 'eriksmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'faza', 'email' => 'faza@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'heru', 'email' => 'herusmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'ibmu', 'email' => 'ibmusmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'Juli', 'email' => 'julismpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'kurikulum', 'email' => 'kurikulum@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'm.', 'email' => 'yudi@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'mihrah', 'email' => 'mihrahsmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'nur', 'email' => 'nursmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'pandu', 'email' => 'pandusmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'prettyana', 'email' => 'prettyanasmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'rasmawati', 'email' => 'rasmawati@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'rika', 'email' => 'rikasmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'rusnah', 'email' => 'rusnahsmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'siti', 'email' => 'sitinurhalisa@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'siti', 'email' => 'sitismpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'sutrisno', 'email' => 'sutrisnosmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'tia', 'email' => 'tiasmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'umi', 'email' => 'umismpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'wulandari', 'email' => 'wulandarismpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'yana', 'email' => 'yanasmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'yeni', 'email' => 'yenismpit@alfityankuburaya.sch.id', 'password' => '12345678'],
            ['name' => 'yuyun', 'email' => 'yuyunsmpit@alfityankuburaya.sch.id', 'password' => '12345678'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
