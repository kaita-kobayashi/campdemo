<?php

namespace App\Http\Requests;

use App\Models\Staff;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StaffRequest extends FormRequest
{
    protected $model;

    public function __construct(Staff $model)
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
     * バリデーションルール
     *
     * @return array
     */
    public function rules()
    {
        $rule = [];
        if (preg_match('/^staff\/create/', $this->route()->uri())) {
            // 新規登録
            $rule = [
                'email_address' => 'required|email|max:50|unique:staff',
                'last_name' => 'required|max:20',
                'first_name' => 'required|max:20',
                'privileges' => 'required',
            ];
        } elseif (preg_match('/^staff\/edit/', $this->route()->uri())) {
            // 編集処理
            $rule = [
                'id' => 'required|exists:staff',
                'email_address' => 'required|email|max:50|exists:staff',
                'password' => 'max:50',
                'last_name' => 'required|max:20',
                'first_name' => 'required|max:20',
                'privileges' => 'required',
                'status' => 'required',
                'tfa_setting' => 'required',
            ];
        }
        return $rule;
    }

    /**
     * 妥当性確認
     *
     * @param \Illuminate\Validation\Validator $validator
     */
    public function withValidator(Validator $validator): void
    {
        if (preg_match('/^staff\/edit/', $this->route()->uri())) {
            $validator->after(function ($validator) {
                $result = $this->model->countEmailAndStaffId($this->email_address, $this->id);
                if ($result !== 1) {
                    $validator->errors()->add('email_address', __('staff.customErrMsg.duplicateEmail'));
                }
            });
        }
    }
}
