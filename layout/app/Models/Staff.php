<?php

namespace App\Models;

use App\Exceptions\CustomException;
use App\Mail\PasswordReset;
use App\Traits\SaveHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Kyslik\ColumnSortable\Sortable;

class Staff extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Sortable;

    public $timestamps = false;
    protected $table = 'staff';
    protected $rememberTokenName = false;
    protected $fillable = [
        'email_address',
        'password',
        'last_name',
        'first_name',
        'privileges',
        'status',
        'login_date',
    ];
    public $sortable = [
        'id',
        'email_address',
        'status',
        'created_date',
        'updated_date',
    ];

    /**
     * 名称ソート用
     *
     * @param Illuminate\Database\Eloquent\Builder
     * @param string $direction
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function nameSortable(Builder $query, string $direction): \Illuminate\Database\Eloquent\Builder
    {
        return $query->orderBy('last_name', $direction)->orderBy('first_name', $direction);
    }

    /**
     * 検索カラム
     *
     * 完全一致：perfectMatch
     * 部分一致：partialMatch
     * 前方一致：prefixMatch
     */
    protected $searchColumns = [
        'id' => 'perfectMatch',
        'email_address' => 'partialMatch',
        'last_name' => 'prefixMatch',
        'first_name' => 'prefixMatch',
        'status' => 'perfectMatch',
    ];

    /**
     * パスワードリセットメール送信
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        Mail::to(['email' => $this->email_address])->send(new PasswordReset($token));
        // $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * メールアドレス返却
     */
    public function getEmailForPasswordReset(): string
    {
        return $this->email_address;
    }

    /**
     * 検索条件
     *
     * @param Illuminate\Database\Eloquent\Builder
     * @param array $search
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, array $postSearch): \Illuminate\Database\Eloquent\Builder
    {
        foreach ($this->searchColumns as $searchColumn => $match) {
            if (array_key_exists($searchColumn, $postSearch) && !is_null($postSearch[$searchColumn])) {
                if ($match === 'perfectMatch') {
                    $query->where($searchColumn, $postSearch[$searchColumn]);
                } elseif ($match === 'partialMatch') {
                    $query->where($searchColumn, 'like', '%' . $postSearch[$searchColumn] . '%');
                } elseif ($match === 'prefixMatch') {
                    $query->where($searchColumn, 'like', $postSearch[$searchColumn] . '%');
                }
            }
        }
        return $query;
    }

    /**
     * スタッフ取得(一覧)
     *
     * @param array $search
     * @param string $showNum
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getStaffList(array $search, string $showNum): \Illuminate\Pagination\LengthAwarePaginator
    {
        $result = $this
            ->search($search)
            ->sortable()
            ->paginate((int)$showNum);

        return $result;
    }

    /**
     * スタッフ取得(一件)
     *
     * @param string $staffId
     * @return \App\Models\Staff
     * @throws \App\Exceptions\CutomException
     */
    public function getStaff(string $staffId): \App\Models\Staff
    {
        $result = $this
            ->where('id', $staffId)
            ->first();

        if (is_null($result)) {
            throw new CustomException(config('errors.ILLEGAL_TRANSITION'));
        }

        return $result;
    }

    /**
     * スタッフ登録
     *
     * @param array $formInput
     * @return void
     * @throws \App\Exceptions\IllegalTransitionException
     */
    public function createStaff(array $formInput): void
    {
        DB::beginTransaction();
        try {
            // データ作成
            $this->create($formInput);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e);
            throw new CustomException(config('errors.FAILD_CREATED'));
        }
    }

    /**
     * スタッフ更新
     *
     * @param array $updateForm
     * @param string $staffId
     * @return void
     */
    public function updateStaff(array $updateForm, string $staffId): void
    {
        DB::beginTransaction();
        try {
            // データ更新
            $this->find($staffId)->update($updateForm);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e);
            throw new CustomException(config('errors.FAILD_UPDATE'));
        }
    }

    /**
     * スタッフ妥当性確認
     *
     * @param string $email
     * @param string $staffId
     * @return int
     */
    public function countEmailAndStaffId(string $email, string $staffId): int
    {
        return $this->where('id', $staffId)
            ->where('email_address', $email)
            ->get()
            ->count();
    }
}
