<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('商品ID');
            $table->unsignedBigInteger('campaign_id')->default(0)->index()->comment('キャンペーンID');
            $table->string('code', 20)->comment('商品コード');
            $table->string('name', 100)->comment('商品名');
            $table->string('name_kana', 100)->comment('商品名カナ');
            $table->string('campany_name', 50)->comment('メーカー名');
            $table->text('description')->comment('説明');
            $table->string('image_file', 100)->comment('画像ファイル');
            $table->string('url', 50)->comment('画像URL');
            $table->unsignedInteger('price')->default(0)->comment('希望小売価格');
            $table->string('jan_code', 13)->comment('JANコード');
            $table->unsignedTinyInteger('sort_order')->default(0)->comment('並び順');
            $table->unsignedTinyInteger('status')->default(0)->comment('ステータス');
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
        Schema::dropIfExists('product');
    }
}
