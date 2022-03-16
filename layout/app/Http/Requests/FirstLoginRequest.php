<?php

namespace App\Http\Requests;

use App\Models\PasswordReset;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class FirstLoginRequest extends FormRequest
{

    protected $model;

    public function __construct(PasswordReset $model)
    {
        $this->model = $model;
    }

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
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    /**
     * 妥当性確認
     *
     * @param \Illuminate\Validation\Validator $validator
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            if (is_null($this->email) || is_null($this->token)) {
                $validator->errors()->add('token_failed', __('login.customErrMsg.illegal_transition'));
                return;
            }
            $result = $this->model->countEmailAndToken($this->email, $this->token);
            if ($result !== 1) {
                $validator->errors()->add('token_failed', __('login.customErrMsg.illegal_transition'));
            }
        });
    }
}
