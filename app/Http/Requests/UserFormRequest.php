<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rules\Password;

class UserFormRequest extends FormRequestAbstract
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
            'store' => self::store(),
        ][$method] ?? [];
    }

    /**
     * Get user rules.
     *
     * @return string[]
     */
    private static function store(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'cpf' => 'required|string|max:12|unique:users,cpf',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', Password::min(5)],
            'role' => 'required|string|exists:roles,slug',
        ];
    }
}
