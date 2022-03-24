<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Arcanedev\NoCaptcha\NoCaptchaV3;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email_address' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => ['required'],
        ];
    }

    /**
     * reCAPTCHA確認
     *
     * @param \Illuminate\Validation\Validator $validator
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $capcha = new NoCaptchaV3(config('no-captcha.secret'), config('no-captcha.sitekey'));
            $response = $capcha->verify($this['g-recaptcha-response'] ?? null);
            $isSuccess = $response->isSuccess();
            $score = $response->getScore();
            if (!$isSuccess || $score <= config('const.RECAOTCHA_FAILD_NUM')) {
                $validator->errors()->add('g-recaptcha-response', __('login.customErrMsg.recaptcha_error'));
            }
        });
    }
}
