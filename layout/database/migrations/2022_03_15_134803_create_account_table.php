<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('アカウントID');
            $table->string('email_address', 50)->unique()->comment('メールアドレス');
            $table->char('password', 128)->comment('パスワード');
            $table->string('company_name', 50)->comment('会社名');
            $table->string('company_name_kana', 50)->comment('会社名カナ');
            $table->string('department_name', 50)->comment('部署名');
            $table->char('postal_code', 7)->comment('郵便番号');
            $table->string('prefecture', 10)->comment('都道府県');
            $table->string('address', 50)->comment('住所');
            $table->string('building', 50)->comment('マンション・ビル名');
            $table->string('phone_number', 11)->comment('電話番号');
            $table->string('mobile_number', 11)->comment('携帯番号');
            $table->string('last_name', 20)->comment('性');
            $table->string('last_name_kana', 20)->comment('性カナ');
            $table->string('first_name', 20)->comment('名');
            $table->string('first_name_kana', 20)->comment('名カナ');
            $table->text('remarks')->comment('備考');
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
        Schema::dropIfExists('account');
    }
}
