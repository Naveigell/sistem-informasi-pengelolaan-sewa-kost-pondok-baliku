<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'name'     => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash("PondokAdminBaliku", PASSWORD_DEFAULT),
                'role'     => User::ROLE_ADMIN,
            ],
        ];

        (new User())->insertBatch($data);

        for ($i = 1; $i <= 15; $i++) {

            $number = str_pad((string) $i, 2, '0', STR_PAD_LEFT);

            (new User())->insert([
                "username" => "pondokbaliku{$number}",
                "name"     => "Pondok Baliku {$number}",
                "email"    => "room{$number}@pondokbaliku.com",
                "password" => password_hash("Pondok01baliku", PASSWORD_DEFAULT),
                "role"     => User::ROLE_MEMBER,
            ]);
        }

        (new User())->insert([
            'username' => 'applicant123',
            'name'     => 'applicant123',
            'email'    => 'applicant@gmail.com',
            'password' => password_hash("123456", PASSWORD_DEFAULT),
            'role'     => User::ROLE_APPLICANT,
        ]);
    }
}
