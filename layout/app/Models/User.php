<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public $timestamps = false;
    protected $table = 'user';
    protected $fillable = [
        'campaign_id',
        'email_address',
        'password',
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'gender',
        'age',
        'postal_code',
        'prefecture',
        'address',
        'phone_number',
        'ip_address',
        'user_agent',
        'cookie_id',
        'status',
        'login_date',
        'tfa_setting',
    ];
}
