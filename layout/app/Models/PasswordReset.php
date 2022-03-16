<?php

namespace App\Models;

use App\Exceptions\CustomException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PasswordReset extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    protected $table = "password_resets";
    protected $fillable = [
        'email',
        'token',
    ];

    /**
     * トークン格納(初回ログイン)
     *
     * @param string $email
     * @param string $token
     * @return void
     * @throws \App\Exceptions\CutomException
     */
    public function setToken(string $email, string $token): void
    {
        DB::beginTransaction();
        try {
            $this->updateOrCreate(
                [ 'email' => $email ],
                [ 'email' => $email, 'token' => $token ]
            );
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e);
            throw new CustomException(config('errors.FAILD_CREATED'));
        }
    }

    /**
     * 妥当性確認
     *
     * @param string $email
     * @param string $token
     * @return int
     */
    public function countEmailAndToken(string $email, string $token): int
    {
        // 作成日時もみる？
        // １週間以内とか
        return $this->where('email', $email)
            ->where('token', $token)
            ->count();
    }
}
