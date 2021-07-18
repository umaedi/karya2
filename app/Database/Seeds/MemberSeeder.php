<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class MemberSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('it_IT');
        for ($i = 0; $i < 199; $i++) {
            $data = [
                'name'           => $faker->name,
                'email'         => $faker->email,
                'created_at'     => Time::createFromTimestamp($faker->unixTime()),
                'updated_at'     => Time::now()

            ];
            $this->db->table('member')->insert($data);
        }
    }
}
