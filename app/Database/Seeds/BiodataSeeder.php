<?php

namespace App\Database\Seeds;

use App\Models\Biodata;
use App\Models\User;
use CodeIgniter\Database\Seeder;

class BiodataSeeder extends Seeder
{
    public function run()
    {
        $biodata = new Biodata();
        $users   = (new User())->whereNotAdmin()->findAll();
        $jobs    = ['CEO', 'CTO', 'Programmer', 'Designer', 'UI/UX'];

        foreach ($users as $user) {
            $biodata->insert([
                "user_id"       => $user['id'],
                "job"           => $jobs[array_rand($jobs)],
                "identity_card" => rand(111111111, 999999999),
                "phone"         => "08" . rand(1111111111, 9999999999),
                "address"       => $this->str_random(20),
            ]);
        }
    }

    public function str_random($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
