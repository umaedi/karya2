<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class OrangSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'nama'          => 'Dikdik Afriyanto',
        //         'alamat'        => 'Jl. kemana aja',
        //         'created_at'    => Time::now(),
        //         'updated_at'      => Time::now()
        //     ],
        //     [
        //         'nama'          => 'Agus',
        //         'alamat'        => 'Jl. yuk',
        //         'created_at'    => Time::now(),
        //         'updated_at'      => Time::now()
        //     ],
        //     [
        //         'nama'          => 'Rudi',
        //         'alamat'        => 'Jl. sama dia',
        //         'created_at'    => Time::now(),
        //         'updated_at'      => Time::now()
        //     ]
        // ];
        $faker = \Faker\Factory::create('it_IT');
        for ($i = 0; $i < 199; $i++) {
            $data = [
                'nama'           => $faker->name,
                'alamat'         => $faker->address,
                'created_at'     => Time::createFromTimestamp($faker->unixTime()),
                'updated_at'     => Time::now()

            ];
            $this->db->table('orang')->insert($data);
        }
        // Simple Queries
        // $this->db->query(
        //     "INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :created_at:, :updated_at:)",
        //     $data
        // );

        // Using Query Builder

        // $this->db->table('orang')->insertBatch($data);
    }
}
