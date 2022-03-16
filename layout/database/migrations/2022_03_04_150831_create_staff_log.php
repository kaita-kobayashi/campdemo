<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStaffLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_log', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ログID');
            $table->unsignedBigInteger('staff_id')->comment('スタッフID');
            $table->string('staff_name', 50)->comment('スタッフ名');
            $table->char('ip_address', 128)->comment('IPアドレス');
            $table->longText('user_agent')->comment('ユーザーエージェント');
            $table->string('event_name', 50)->comment('イベント名');
            $table->text('event_description')->comment('イベント説明');
            $table->string('source', 50)->comment('ソース');
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
        Schema::dropIfExists('staff_log');
    }
}
