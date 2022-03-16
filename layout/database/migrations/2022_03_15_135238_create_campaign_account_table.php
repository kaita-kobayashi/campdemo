<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCampaignAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_account', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('キャンペーンアカウントID');
            $table->unsignedBigInteger('campaign_id')->default(0)->index()->comment('キャンペーンID');
            $table->unsignedBigInteger('account_id')->default(0)->index()->comment('アカウントID');
            $table->string('email_address', 50)->index()->comment('メールアドレス');
            $table->unsignedTinyInteger('role')->default(0)->comment('ロール');
            $table->longText('privileges')->comment('権限');
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
        Schema::dropIfExists('campaign_account');
    }
}
