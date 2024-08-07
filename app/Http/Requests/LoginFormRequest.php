<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rules\Password;

class LoginFormRequest extends FormRequestAbstract
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method = $this->route()?->getActionMethod();

        return [
            'login' => self::login(),
        ][$method] ?? [];
    }

    /**
     * Get login rules.
     *
     * @return array
     */
    private static function login(): array
    {
        return [
            'email' => 'required|string|email|max:255',
            'password' => ['required', Password::min(5)],
        ];
    }
}
