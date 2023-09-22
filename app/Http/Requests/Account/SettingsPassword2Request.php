<?php

namespace App\Http\Requests\Account;

use App\Rules\MatchOldPassword2;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class SettingsPassword2Request extends FormRequest
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
            'current_password2' => ['required', new MatchOldPassword2],
            'password2'         => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}