<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('キャンペーンID');
            $table->unsignedBigInteger('account_id')->default(0)->index()->comment('アカウントID');
            $table->string('name', 50)->comment('キャンペーン名');
            $table->text('description')->comment('説明');
            $table->unsignedTinyInteger('type')->default(0)->comment('種別');
            $table->string('subdomain', 20)->unique()->comment('サブドメイン');
            $table->json('settings')->comment('設定');
            $table->timestamp('open_date')->nullable()->comment('ページ公開開始日');
            $table->timestamp('close_date')->nullable()->comment('ページ公開終了日');
            $table->timestamp('start_date')->nullable()->comment('キャンペーン公開開始日');
            $table->timestamp('end_date')->nullable()->comment('キャンペーン公開終了日');
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
        Schema::dropIfExists('campaign');
    }
}
