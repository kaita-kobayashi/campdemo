<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = new Product();
        $insertForm = [];

        for ($i = 1; $i <= 4; $i++) {
            $insertForm[] = [
                'campaign_id' => 1,
                'code' => 'product_' . (string)$i,
                'name' => '商品' . (string)$i,
                'name_kana' => 'ダミー',
                'campany_name' => 'ダミー',
                'description' => '商品' . (string)$i . 'の説明',
                'image_file' => 'sample' . (string)$i . '.png',
                'url' => 'dummy',
                'price' => rand(1, 1000),
                'jan_code' => 'product_' . (string)$i,
                'sort_order' => $i,
                'status' => 1,
            ];
        };

        $tmp = [
            '1' => 'A',
            '2' => 'B',
            '3' => 'C',
            '4' => 'D',
            '5' => 'E',
        ];
        for ($i = 1; $i <= 5; $i++) {
            $insertForm[] = [
                'campaign_id' => 2,
                'code' => 'product_' . $tmp[$i],
                'name' => '商品' . $tmp[$i],
                'name_kana' => 'ダミー',
                'campany_name' => 'ダミー',
                'description' => '商品' . $tmp[$i] . 'の説明',
                'image_file' => 'sample' . $tmp[$i] . '.png',
                'url' => 'dummy',
                'price' => rand(1, 1000),
                'jan_code' => 'product1_' . $tmp[$i],
                'sort_order' => $i,
                'status' => 1,
            ];
        };

        foreach ($insertForm as $data) {
            $staff->create($data);
        }
    }
}
