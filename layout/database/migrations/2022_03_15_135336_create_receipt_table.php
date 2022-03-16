<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('レシートID');
            $table->unsignedBigInteger('campaign_id')->default(0)->index()->comment('キャンペーンID');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('image_file', 100)->comment('画像ファイル');
            $table->json('scan_data')->comment('読み取りデータ');
            $table->timestamp('purchase_date')->nullable()->default(null)->comment('購入日時');
            $table->string('store_name', 50)->nullable()->default(null)->comment('購入店舗');
            $table->string('phone_number', 11)->nullable()->default(null)->comment('電話番号');
            $table->json('products')->nullable()->default(null)->comment('購入商品');
            $table->unsignedInteger('total_price')->default(0)->comment('購入金額');
            $table->unsignedTinyInteger('valid_flag')->default(0)->comment('有効フラグ');
            $table->timestamp('created_date')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('登録日時');
            $table->timestamp('updated_date')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipt');
    }
}
