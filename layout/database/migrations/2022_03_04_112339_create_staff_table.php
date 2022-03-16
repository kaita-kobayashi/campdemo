<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('スタッフID');
            $table->string('email_address', 50)->unique()->comment('メールアドレス');
            $table->char('password', 128)->comment('パスワード');
            $table->string('last_name', 20)->comment('性');
            $table->string('first_name', 20)->comment('名');
            $table->longText('privileges')->comment('権限');
            $table->unsignedTinyInteger('status')->default(0)->comment('ステータス');
            $table->timestamp('login_date')->nullable()->default(null)->comment('ログイン日時');
            $table->unsignedTinyInteger('tfa_setting')->default(1)->comment('二要素認証設定');
            $table->char('tfa_token', 4)->nullable()->default(null)->comment('二要素認証トークン');
            $table->timestamp('tfa_expiration')->nullable()->default(null)->comment('二要素認証有効期限');
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
        Schema::dropIfExists('staff');
    }
}
