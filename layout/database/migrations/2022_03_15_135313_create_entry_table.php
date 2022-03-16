<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('応募ID');
            $table->unsignedBigInteger('campaign_id')->default(0)->index()->comment('キャンペーンID');
            $table->unsignedBigInteger('user_id')->default(0)->index()->comment('ユーザーID');
            $table->unsignedBigInteger('receipt_id')->default(0)->index()->comment('レシートID');
            $table->unsignedBigInteger('prize_id')->default(0)->index()->comment('景品ID');
            $table->json('answer')->comment('アンケート回答');
            $table->unsignedTinyInteger('valid_flag')->default(0)->comment('有効フラグ');
            $table->unsignedTinyInteger('winner_flag')->default(0)->comment('当選フラグ');
            $table->unsignedTinyInteger('w_chance_flag')->default(0)->comment('Wチャンスフラグ');
            $table->timestamp('entry_date')->default(DB::raw('CURRENT_TIMESTAMP'))->index()->comment('応募日時');
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
        Schema::dropIfExists('entry');
    }
}
