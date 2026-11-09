<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FakeData extends Seeder
{
    public function run()
    {
        for ($i=0; $i < 5000; $i++) {
            $faker = \Faker\Factory::create();
            $data = [
                [
                    'kdplg' => $faker->ean8,
                    'namaplg' => $faker->name,
                    'alamat'=> $faker->address,
                    'nohp'=> $faker->e164PhoneNumber
                ],
            ];

            $this->db->table('pelanggan')->insertBatch($data);
        }
    }
}
