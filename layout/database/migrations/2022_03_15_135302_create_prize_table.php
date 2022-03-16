<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePrizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prize', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('景品ID');
            $table->unsignedBigInteger('campaign_id')->default(0)->index()->comment('キャンペーンID');
            $table->string('course_name', 50)->comment('コース名');
            $table->string('name', 100)->comment('景品名');
            $table->string('name_kana', 100)->comment('景品名カナ');
            $table->text('description')->comment('説明');
            $table->string('image_file', 100)->comment('画像ファイル');
            $table->unsignedTinyInteger('selectable')->default(0)->comment('選択形式');
            $table->unsignedInteger('required_unit')->default(0)->comment('応募口数');
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
        Schema::dropIfExists('prize');
    }
}
