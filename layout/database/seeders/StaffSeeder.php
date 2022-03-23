<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = new Staff();
        $insertForm = [];

        $insertForm[] = [
            'email_address' => 'kaita.kobayashi@sharing-innovations.co.jp',
            'password' => Hash::make('password'),
            'last_name' => 'kobayashi',
            'first_name' => 'kaita',
            'privileges' => '{}',
            'status' => 1,
        ];
        $insertForm[] = [
            'email_address' => 'kobayashi120909@gmail.com',
            'password' => Hash::make('password'),
            'last_name' => '管理者',
            'first_name' => '太郎',
            'privileges' => '{}',
            'status' => 1,
        ];

        for ($i = 3; $i <= 120; $i++) {
            $insertForm[] = [
                'email_address' => 'sample' . (string)$i . '@gmail.com',
                'password' => Hash::make('password'),
                'last_name' => 'スタッフ',
                'first_name' => (string)$i,
                'privileges' => '{}',
                'status' => 0,
            ];
        }
        foreach ($insertForm as $data) {
            $staff->create($data);
        }
    }
}
