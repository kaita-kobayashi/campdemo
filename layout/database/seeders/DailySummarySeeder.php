<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\DailySummary;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DailySummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new DailySummary();
        $num = Campaign::count('id');
        $insertForm = [];
        $now = new Carbon();

        for ($i = 1; $i <= 30; $i++) {
            $campaignId = rand(1, $num);
            $productData = Product::where('campaign_id', $campaignId)->get();
            $productId = rand(1, $productData->count());
            $products = [];
            for ($n = 1; $n <= rand(1, 5); $n++) {
                $products[(string)$n][] = [
                    'id' => $productId,
                    'name' => Product::where('id', $productId)->first()->name,
                    'quentity' => rand(1, 99),
                ];
            };

            $insertForm[] = [
                'campaign_id' => $campaignId,
                'date' => $now->addDays(1)->toDateString(),
                'count' => 200,
                'products' => json_encode($products, JSON_UNESCAPED_UNICODE),
                'prizes' => '{}',
            ];
        };

        foreach ($insertForm as $data) {
            $model->create($data);
        }
    }
}
