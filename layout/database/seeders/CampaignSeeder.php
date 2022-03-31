<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Campaign();
        $insertForm = [];
        $now = Carbon::now();
        $insertForm[] = [
            'name' => 'サンプルキャンペーン1',
            'description' => 'demo版用のサンプルキャンペーン1',
            'type' => 0,
            'subdomain' => 'sample1',
            'settings' => '{}',
            'open_date' => $now,
            'close_date' => $now->addMonth(2),
            'start_date' => $now,
            'end_date' => $now->addMonth(2),
            'status' => 2,
        ];
        $insertForm[] = [
            'name' => 'サンプルキャンペーン2',
            'description' => 'demo版用のサンプルキャンペーン2',
            'type' => 0,
            'subdomain' => 'sample2',
            'settings' => '{}',
            'open_date' => $now,
            'close_date' => $now->addMonth(2),
            'start_date' => $now,
            'end_date' => $now->addMonth(2),
            'status' => 2,
        ];
        foreach ($insertForm as $data) {
            $model->create($data);
        }
    }
}
