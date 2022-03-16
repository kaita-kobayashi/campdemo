<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ファイルID');
            $table->unsignedBigInteger('campaign_id')->default(0)->index()->comment('キャンペーンID');
            $table->string('subdomain', 20)->comment('サブドメイン');
            $table->string('file', 100)->comment('ファイル');
            $table->string('file_name', 50)->comment('ファイル名');
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
        Schema::dropIfExists('file');
    }
}
