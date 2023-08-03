<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ExampleSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'verify_key' => '12345678',
            ],
            [
                'id' => 2,
                'name' => 'Rakibul',
                'email' => 'rakib@codeigniter4.com',
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'verify_key' => '12345678',
            ],
            [
                'id' => 3,
                'name' => 'Jane Hoe',
                'email' => 'jone@yahoo.com',
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'verify_key' => '12345678',
            ],
        ];

        $builder = $this->db->table('user');

        foreach ($users as $user) {
            $builder->insert($user);
        }
    }
}
