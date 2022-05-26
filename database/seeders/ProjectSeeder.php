<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'title' => 'Cipher Block Chaining Modification using PRNG',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, provident. Quidem esse possimus, aliquid fuga, nobis, tempora neque similique nihil ab perferendis corrupti sit quaerat reiciendis culpa officia ex eum?'
            ],
            [
                'title' => 'Realtime Non-contact Respiration Rate Observation System',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, eum itaque voluptas modi, magnam quas dignissimos obcaecati, numquam fugiat quidem ut recusandae laboriosam facilis aliquam illo dolore dolorem tempora eius.'
            ]
        ]);
    }
}
