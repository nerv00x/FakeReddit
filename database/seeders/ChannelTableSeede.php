<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChannelTableSeede extends Seeder
{
    public function run()
    {
        DB::table('channels')->insert([
            'title' => 'Python',
            'slug' => 'Pyt',
            'color' => 'purple' // Puedes usar bcrypt para cifrar la contraseña
        ]);
        DB::table('channels')->insert([
            'title' => 'JavaScript',
            'slug' => 'Js',
            'color' => 'red' // Puedes usar bcrypt para cifrar la contraseña
        ]);
        DB::table('channels')->insert([
            'title' => 'PHP',
            'slug' => 'PHP',
            'color' => 'blue' // Puedes usar bcrypt para cifrar la contraseña
        ]);
    }
}
