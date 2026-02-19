<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Support\Settings;
use App\Services\PhoneNormalizer;

class ForgotPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' =>  ['required','string']
        ];
    }

    /**
     * Detect email or phone based on admin setting
     */
    public function loginField(): string
    {
        $login      =   $this->input('login');
        $isEmail    =   filter_var($login, FILTER_VALIDATE_EMAIL);
        $mode       =   Settings::get('login_mode','both');

        if($mode === 'email' && !$isEmail){
            abort(422, 'Only email is allowed to reset password.');
        }

        if($mode === 'phone' && $isEmail){
            abort(422, 'Only phone is allowed to reset password.');
        }

        return $isEmail ? 'email' : 'phone';
    }

    public function credentials():array
    {
        $field = $this->loginField();
        $login = $this->input('login');

        if($field === 'phone'){
            $login = PhoneNormalizer::normalize($login);
        }

        return[
            $field  =>  $login,
            'login_mode' => $field
        ];
    }
}
