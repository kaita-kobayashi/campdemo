<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ユーザーID');
            $table->unsignedBigInteger('campaign_id')->default(0)->index()->comment('キャンペーンID');
            $table->string('email_address', 50)->unique()->comment('メールアドレス');
            $table->char('password', 128)->comment('パスワード');
            $table->string('last_name', 20)->comment('性');
            $table->string('last_name_kana', 20)->comment('性カナ');
            $table->string('first_name', 20)->comment('名');
            $table->string('first_name_kana', 20)->comment('名カナ');
            $table->string('gender', 10)->comment('性別');
            $table->unsignedTinyInteger('age')->default(0)->comment('年齢');
            $table->char('postal_code', 7)->comment('郵便番号');
            $table->string('prefecture', 10)->comment('都道府県');
            $table->string('address', 100)->comment('住所（市区町村、番地、ビル）');
            $table->string('phone_number', 11)->comment('電話番号');
            $table->char('ip_address', 50)->comment('IPアドレス');
            $table->longText('user_agent')->comment('ユーザーエージェント');
            $table->string('cookie_id', 50)->comment('クッキーID');
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
        Schema::dropIfExists('user');
    }
}
